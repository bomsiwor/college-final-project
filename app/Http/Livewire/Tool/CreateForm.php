<?php

namespace App\Http\Livewire\Tool;

use App\Models\Tool;
use Livewire\Component;

class CreateForm extends Component
{
    public $name, $inventory_number, $merk, $series, $purchase_date, $price;
    public $condition, $status, $description, $value;
    public $changed = false;

    protected $rules = [
        'name' => 'required',
        'inventory_number' => 'required',
        'merk' => 'required',
        'series' => 'required',
        'condition' => 'required',
        'status' => 'required',
        'purchase_date' => 'required',
        'price' => 'required|integer|min:1000'
    ];

    public function updatedValue($value)
    {
        $this->description = $value;
    }

    public function submit()
    {
        $this->changed = false;
        $validated = $this->validate();

        $validated = array_merge($validated, ['description' => $this->description]);

        Tool::create($validated);
        $this->reset();
        $this->changed = true;
    }

    public function render()
    {

        return view('livewire.tool.create-form');
    }
}
