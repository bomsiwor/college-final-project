<?php

namespace App\Http\Livewire\Admin;

use App\Models\RadioactiveReturning;
use Livewire\Component;

class RadioactiveReturningComponent extends Component
{
    public $returnings;

    public function loadData()
    {
        $this->returnings = RadioactiveReturning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'created_at')
            ->with('verificator:id,name')
            ->orderBy('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.radioactive-returning-component');
    }
}
