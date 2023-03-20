<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RadiationLogComponent extends Component
{
    public $dose, $start_time, $end_time, $description;

    protected $rules = [
        'dose' => 'required|numeric',
        'start_time' => 'required',
        'end_time' => 'required'
    ];

    public function submit()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.radiation-log-component');
    }
}
