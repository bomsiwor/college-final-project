<?php

namespace App\Http\Livewire\Activity;

use App\Models\Tool;
use App\Models\ToolLog as ModelsToolLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ToolLog extends Component
{
    public $detector,
        $start_time,
        $end_time,
        $hv,
        $adc,
        $amp,
        $start_doses,
        $end_doses,
        $laju_paparan,
        $purpose,
        $inventory_id;

    public $hv_active = false;
    public $amp_active = false;
    public $adc_active = false;
    public $xmet_active = false;

    public $data = [];
    public $data_added = false;

    public function hydrate()
    {
        $this->data_added = false;
    }

    public function updated($name, $value)
    {
        $this->xmet_active = ($value == 'xrf');
        $this->hv_active = ($value == 'naitl' || $value == 'gm' || $value == 'xrf');
        $this->amp_active = ($value == 'naitl' || $value == 'gm' || $value == 'xrf');
        $this->adc_active = ($value == 'naitl' || $value == 'gm');
    }

    public function submit()
    {
        $validated = $this->validate([
            'start_time' => 'required',
            'end_time' => 'required|after_or_equal:start_time',
            'detector' => 'required',
            'purpose' => 'required'
        ]);

        $additional = $this->validate([
            'hv' => 'exclude_unless:detector,naitl,gm,xrf|required_if:detector,gm,naitl,xrf|numeric',
            'amp' => 'exclude_unless:detector,naitl,gm,xrf|required_if:detector,naitl,gm,xrf|numeric',
            'start_doses' => 'exclude_unless:detector,xrf|required_if:detector,xrf|numeric',
            'end_doses' => 'exclude_unless:detector,xrf|required_if:detector,xrf|numeric',
            'laju_paparan' => 'exclude_unless:detector,xrf|required_if:detector,xrf|numeric',
            'adc' => 'exclude_if:adc,null|numeric'
        ]);

        $this->inventory_id = Tool::select('inventory_unique as data')->where('log_flag', $this->detector)->first();

        $required_data = [
            'inventory_id' => $this->inventory_id->data,
            'user_id' => auth()->user()->id,
            'log_date' => now(),
            'end_condition' => 'good'
        ];

        $this->data += $validated;
        $this->data += $required_data;
        $this->data['additional'] = $additional;

        try {
            DB::transaction(function () {
                ModelsToolLog::create($this->data);

                Tool::updateConditionBy('log_flag', $this->detector, [
                    'condition' => 'good'
                ]);
            });
        } catch (\Throwable $e) {
            return $this->addError('error', $e->getMessage());
        }

        $this->reset();
        $this->data_added = true;
    }

    public function render()
    {
        return view('livewire.activity.tool-log');
    }
}
