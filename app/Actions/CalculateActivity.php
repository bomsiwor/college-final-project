<?php 
namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

trait CalculateActivity
{
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
}
