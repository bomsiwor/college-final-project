<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Returning;

class ToolReturningComponent extends Component
{
    public $returnings;

    public function loadData()
    {
        $this->returnings = Returning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'condition', 'created_at')
            ->with('verificator:id,name', 'borrow:id')
            ->orderBy('created_at')->get();
    }

    public function render()
    {
        return view('livewire.admin.tool-returning-component');
    }
}
