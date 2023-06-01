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

    public function render()
    {
        return view('livewire.radioactive.levels-data-component');
    }
}
