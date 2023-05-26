<?php

namespace App\Http\Livewire\Tool;

use App\Models\ReportProblem;
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

        if (!$this->storeData()) :
            $this->addError('failed', 'Gagal ditambahkan!');
        endif;

        $this->dispatchBrowserEvent('request-stored');
    }

    private function storeData(): bool
    {
        $model = ReportProblem::create([
            'user_id' => auth()->id(),
            'tool_id' => $this->inventory_id,
            'condition' => $this->condition,
            'description' => $this->description
        ]);

        if (!$model->wasRecentlyCreated) :
            return false;
        endif;

        return true;
    }

    public function render()
    {
        $data = Tool::select('inventory_unique', 'name', 'inventory_number', 'id')->get();

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
