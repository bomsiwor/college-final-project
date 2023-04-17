<?php

namespace App\Http\Livewire\Activity;

use App\Actions\StoreToolLogAction;
use Livewire\Component;

class ToolLog extends Component
{
    public
        $detector,
        $start_time,
        $end_time,
        $hv,
        $adc,
        $amp,
        $start_doses,
        $end_doses,
        $laju_paparan,
        $purpose,
        $inventory_id,
        $hv_active = false,
        $amp_active = false,
        $adc_active = false,
        $xmet_active = false,
        $data = [],
        $data_added = false;

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

    public function submit(StoreToolLogAction $action)
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

        $response = $action->handle($validated, $additional);

        if ($response) :
            $this->reset();
            $this->data_added = $response;
        else :
            $this->addError('error', 'Gagal menambahkan, coba lagi!');
        endif;
    }

    public function render()
    {
        return view('livewire.activity.tool-log');
    }
}
