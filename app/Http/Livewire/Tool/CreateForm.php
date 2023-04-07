<?php

namespace App\Http\Livewire\Tool;

use App\Models\Tool;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateForm extends Component
{
    public $name, $inventory_number, $merk, $series, $purchase_date, $price;
    public $condition, $status, $description, $value, $used_status;
    public $changed = false;

    protected $rules = [
        'name' => 'required',
        'inventory_number' => 'required',
        'merk' => 'required',
        'series' => 'required',
        'condition' => 'required',
        'status' => 'required',
        'purchase_date' => 'required',
        'price' => 'nullable|integer|min:1000'
    ];

    public function updatedValue($value)
    {
        $this->description = $value;
    }

    public function submit()
    {
        $this->changed = false;
        $validated = $this->validate();

        $validated = array_merge($validated, [
            'description' => $this->description,
            'inventory_unique' => Str::uuid(),
            'used_status' => $this->used_status
        ]);

        try {
            Tool::create($validated);
        } catch (\Throwable $e) {
            return $this->addError('failed', $e->getMessage());
        }

        $this->reset();
        $this->changed = true;
        $this->emit('toolsAdded');
    }

    public function render()
    {

        return view('livewire.tool.create-form');
    }
}
