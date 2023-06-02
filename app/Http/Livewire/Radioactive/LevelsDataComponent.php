<?php

namespace App\Http\Livewire\Radioactive;

use App\Actions\GetNuclideAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LevelsDataComponent extends Component
{
    public $slug;
    public $radioactive_id;
    public $apiData;

    public $initialActivity;
    public $half_life;
    public $activity;
    public $activity_bq;

    public $gamma_decays;
    public $alpha_decay;
    public $beta_decay;
    public $xray_decay;

    public function loadData(GetNuclideAction $action)
    {
        // Get IAEA Data form API
        $field = "levels";
        $this->apiData = Cache::remember("$field.$this->slug", now()->addMonths(3), function () use ($action, $field) {
            return $action->handle($this->slug, $field);
        }); // Save to cache

        // Get half life
        $this->half_life = (float) ($this->apiData)[0]['half_life_sec'];

        // Get radioactive DB
        $radioactive = $this->getRadioactiveData($this->radioactive_id);
        $this->initialActivity = $radioactive->initial_activity;

        $elapsedTime = Carbon::parse($radioactive->manufacturing_date)->diffInSeconds(now());

        $this->activity = number_format($this->formulateActivity($elapsedTime, $this->initialActivity), 6);

        $this->activity_bq = $this->activity * 37000;

        $this->makeDecayChart($action);
    }

    private function getRadioactiveData(int $id)
    {
        return DB::table('radioactives')
            ->select('id', 'initial_activity', 'manufacturing_date')
            ->where('id', '=', $id)
            ->first();
    }

    private function formulateActivity($elapsedTime, $initialActivity)
    {
        $lambda = log(2) / $this->half_life;

        $decayFactor = exp(-$lambda * $elapsedTime);

        $activity = $initialActivity * $decayFactor;

        return $activity;
    }

    private function makeDecayChart(GetNuclideAction $action)
    {
        $field = "decay_rads";
        // Gamma
        $this->gamma_decays = Cache::remember($field . $this->slug . "g", now()->addMonths(3), function () use ($action, $field) {
            return $action->handle($this->slug, $field, "g");
        });
        $cleanerGammaData = $this->gamma_decays->reject(function ($item) {
            if ($item['intensity'] == " " || $item['intensity'] < 0.001) :
                return true;
            endif;
        });

        // Alpha
        $this->alpha_decay = Cache::remember($field . $this->slug . "a", now()->addMonths(3), function () use ($action, $field) {
            return $action->handle($this->slug, $field, "a");
        });
        $cleanerAlphaData = $this->alpha_decay->reject(function ($item) {
            if ($item['intensity'] == " " || $item['intensity'] < 0.001) :
                return true;
            endif;
        });

        // Beta
        $this->beta_decay = Cache::remember($field . $this->slug . "bm", now()->addMonths(3), function () use ($action, $field) {
            return $action->handle($this->slug, $field, "bm");
        });
        $cleanerBetaData = $this->beta_decay->reject(function ($item) {
            if (isset($item['intensity'])) :
                if ($item['intensity'] == " " || $item['intensity'] < 0.001) :
                    return true;
                endif;
            else :
                return true;
            endif;
        });

        // Xray
        $this->xray_decay = Cache::remember($field . $this->slug . "x", now()->addMonths(3), function () use ($action, $field) {
            return $action->handle($this->slug, $field, "x");
        });


        $data['gamma']['energy'] = $cleanerGammaData->pluck('energy');
        $data['gamma']['intensity'] = $cleanerGammaData->pluck('intensity');

        $data['alpha']['energy'] = $cleanerAlphaData->pluck('energy');
        $data['alpha']['intensity'] = $cleanerAlphaData->pluck('intensity');

        $data['beta']['energy'] = $cleanerBetaData->pluck('energy');
        $data['beta']['intensity'] = $cleanerAlphaData->pluck('intensity');

        $data['xray']['energy'] = $this->xray_decay->pluck('energy');
        $data['xray']['intensity'] = $this->xray_decay->pluck('intensity');
        // $data['xray']['energy'] = $cleanerXrayData->pluck('energy');
        // $data['xray']['intensity'] = $cleanerAlphaData->pluck('intensity');

        // dd($data);

        $this->emit('makeChart', $data);
    }

    public function render()
    {
        return view('livewire.radioactive.levels-data-component');
    }
}
