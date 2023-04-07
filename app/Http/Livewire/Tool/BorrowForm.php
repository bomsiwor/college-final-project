<?php

namespace App\Http\Livewire\Tool;

use App\Models\Borrow;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BorrowForm extends Component
{
    public $toolName, $invNumber, $start_borrow_date, $purpose, $description, $expected_return_date, $invUniq;

    protected $listeners = [
        'refreshForm' => '$refresh'
    ];

    protected $rules = [
        'start_borrow_date' => 'required|date|after_or_equal:today',
        'expected_return_date' => 'required|date|after_or_equal:start_borrow_date',
        'purpose' => 'required',
        'description' => 'required_if:purpose,other'
    ];

    public function mount($tool)
    {
        $this->toolName = $tool->name;
        $this->invNumber = $tool->inventory_number;
        $this->invUniq = $tool->inventory_unique;
    }

    public function submit()
    {
        $data = $this->validate();

        $additional = [
            'user_id' => Auth::user()->id,
            'inventory_id' => $this->invUniq
        ];

        $data += $additional;

        try {
            Borrow::create($data);
        } catch (\Throwable $e) {
            $this->addError('failed', $e->getCode() . " : Jaringan error. Gagal menambahkan");
        }

        $this->dispatchBrowserEvent('added-borrow');
        $this->emitSelf('refreshform');
    }

    public function render()
    {
        return view('livewire.tool.borrow-form');
    }
}
