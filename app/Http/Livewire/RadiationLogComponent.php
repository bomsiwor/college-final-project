<?php

namespace App\Http\Livewire;

use App\Actions\StoreRadiationLogAction;
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

    public function submit(StoreRadiationLogAction $action)
    {
        $data = $this->validate();

        $response = $action->handle($data);

        if ($response->wasRecentlyCreated) :
            $this->reset();
            $this->data_added = true;
            $this->dispatchBrowserEvent('attendance-stored');
        else :
            $this->addError('error', 'Gagal menambahkan! Coba lagi.');
        endif;
    }

    public function render()
    {
        return view('livewire.radiation-log-component');
    }
}
