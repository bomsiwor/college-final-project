<?php

namespace App\Http\Livewire\Radioactive;

use App\Models\Borrow;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BorrowForm extends Component
{
    public $name,
        $invNumber,
        $entryNumber,
        $start_borrow_date,
        $purpose,
        $description,
        $expected_return_date,
        $invUniq,
        $before_condition;

    protected $rules = [
        'start_borrow_date' => 'required|date|after_or_equal:today',
        'expected_return_date' => 'required|date|after_or_equal:start_borrow_date',
        'purpose' => 'required',
        'description' => 'required_if:purpose,other',
    ];

    protected $listeners = [
        'refreshForm' => '$refresh'
    ];

    public function mount($radioactive)
    {
        $this->name = $radioactive->element_name;
        $this->entryNumber = $radioactive->entry_number;
        $this->invNumber = $radioactive->inventory_number;
        $this->invUniq = $radioactive->inventory_unique;
        $this->before_condition = $radioactive->condition;
    }

    public function submit()
    {
        $data = $this->validate();

        $additional = [
            'user_id' => Auth::user()->id,
            'inventory_id' => $this->invUniq,
            'before_condition' => $this->before_condition
        ];

        $data += $additional;

        try {
            Borrow::create($data);
        } catch (\Throwable $e) {
            return $this->addError('failed', $e->getMessage());
        }

        $this->dispatchBrowserEvent('added-borrow');
        $this->emitSelf('refreshform');
    }

    public function render()
    {
        return view('livewire.radioactive.borrow-form');
    }
}
