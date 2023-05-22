<?php

namespace App\Http\Livewire\Radioactive;

use App\Models\Radioactive;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateForm extends Component
{
    public $element_name,
        $isotope_number,
        $element_symbol,
        $entry_number,
        $inventory_number,
        $purchase_date,
        $manufacturing_date,
        $initial_activity,
        $packaging_type,
        $status,
        $condition,
        $properties,
        $quantity,
        $description;

    protected $validationAttributes = [
        'element_name' => 'Nama unsur'
    ];

    public function submit()
    {
        $validated = $this->validate();

        $finalData = $this->generateIdentifier($validated);

        try {
            Radioactive::create($finalData);
        } catch (\Throwable $e) {
            return $this->addError('failed', $e->getMessage());
        }

        return to_route('radioactive.index')->with('success', 'Sukses menambahkan data');
    }

    public function generateIdentifier(array $validated): array
    {
        // Create inventory unique
        $unique_number = ['inventory_unique' => Str::uuid()->toString()];

        // Create slug
        $slug = ['slug' => $this->isotope_number . $this->element_symbol];

        $addedUnique = array_merge($validated, $unique_number, $slug);
        return $addedUnique;
    }

    protected function rules(): array
    {
        return [
            'element_name' => 'required',
            'isotope_number' => 'required',
            'element_symbol' => 'required',
            'purchase_date' => 'nullable',
            'manufacturing_date' => 'required|before:today',
            'initial_activity' => 'required|numeric|min:0.001',
            'packaging_type' => 'required',
            'status' => 'required',
            'condition' => 'required',
            'properties' => 'required',
            'description' => 'nullable',
            'inventory_number' => 'nullable',
            'quantity' => 'required|numeric|min:0',
            'entry_number' => 'required|numeric|unique:radioactives,entry_number|min:1'
        ];
    }

    public function render()
    {
        return view('livewire.radioactive.create-form');
    }
}
