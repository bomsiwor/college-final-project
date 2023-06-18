<?php

namespace App\Http\Livewire\Tool;

use App\Models\Tool;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateForm extends Component
{
    use WithFileUploads;

    public $name, $inventory_number, $merk, $series, $purchase_date, $price;
    public $condition, $status, $description, $value, $used_status;
    public $image = [];
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
        'description' => 'nullable',
        'image.*' => 'image|max:2048'
    ];

    public function submit()
    {
        $this->changed = false;
        $validated = $this->validate();

        $validated = array_merge($validated, [
            'inventory_unique' => Str::uuid()->toString(),
            'tool_image' => $this->createImageName()
        ]);

        unset($validated['image']);

        // dd($validated);

        try {
            Tool::create($validated);
        } catch (\Throwable $e) {
            return $this->addError('failed', $e->getMessage());
        }

        $this->reset();
        $this->changed = true;

        return to_route('tool.index')->with('success', 'Sukses menambahkan data!');
    }

    private function createImageName(): array
    {
        $data = [];
        foreach ($this->image as $key => $value) :
            $name = Str::slug($this->name) . now()->getTimestamp() . '.' . $value->getClientOriginalExtension();
            $value->storeAs('inventory-images', $name);
            $data["image_$key"]['name'] = $name;
            $data["image_$key"]['description'] = $this->name;
        endforeach;

        return $data;
    }

    public function render()
    {

        return view('livewire.tool.create-form');
    }
}
