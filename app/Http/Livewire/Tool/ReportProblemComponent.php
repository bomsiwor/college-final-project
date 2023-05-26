<?php

namespace App\Http\Livewire\Tool;

use App\Models\Tool;
use Livewire\Component;

class ReportProblemComponent extends Component
{
    public $inventory_id,
        $condition,
        $description;

    public function submit()
    {
        $this->validate();

        $this->dispatchBrowserEvent('request-stored');
    }

    public function render()
    {
        $data = Tool::select('inventory_unique', 'name', 'inventory_number')->get();

        return view('livewire.tool.report-problem-component', compact('data'));
    }

    protected function rules()
    {
        return [
            'inventory_id' => 'required',
            'condition' => 'required',
            'description' => 'required'
        ];
    }
}
