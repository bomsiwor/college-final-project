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
        'inventory_number' => 'nullable',
        'merk' => 'required',
        'series' => 'required',
        'condition' => 'required',
        'status' => 'required',
        'used_status' => 'required',
        'purchase_date' => 'required|before_or_equal:today',
        'price' => 'nullable|integer|min:1000',
        'description' => 'nullable'
    ];

    public function submit()
    {
        $this->changed = false;
        $validated = $this->validate();

        $validated = array_merge($validated, [
            'inventory_unique' => Str::uuid()->toString(),
        ]);

        try {
            Tool::create($validated);
        } catch (\Throwable $e) {
            return $this->addError('failed', $e->getMessage());
        }

        $this->reset();
        $this->changed = true;

        return to_route('tool.index')->with('success', 'Sukses menambahkan data!');
    }

    public function render()
    {

        return view('livewire.tool.create-form');
    }
}
