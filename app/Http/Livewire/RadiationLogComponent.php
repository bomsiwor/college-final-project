<?php

namespace App\Http\Livewire;

use App\Models\RadiationLog;
use Livewire\Component;

class RadiationLogComponent extends Component
{
    public $dose, $start_time, $end_time, $description, $purpose;

    public $data_added = false;


    protected $rules = [
        'dose' => 'required|numeric|min:0',
        'start_time' => 'required',
        'end_time' => 'required|after_or_equal:start_time',
        'purpose' => 'required'
    ];

    public function hydrate()
    {
        $this->data_added = false;
    }

    public function submit()
    {
        $data = $this->validate();

        $data += [
            'user_id' => auth()->id(),
            'log_date' => now()
        ];


        try {
            RadiationLog::create($data);
        } catch (\Throwable $e) {
            return $this->addError('error', $e->getMessage());
        }

        $this->reset();
        $this->data_added = true;
    }

    public function render()
    {
        return view('livewire.radiation-log-component');
    }
}
