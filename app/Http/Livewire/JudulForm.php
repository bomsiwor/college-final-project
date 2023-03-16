<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JudulForm extends Component
{
    public $title;
    public $newTitle;
    public $changed = FALSE;

    public function mount()
    {
        $this->title = "Judul asli";
    }

    public function changeTitle()
    {
        $this->title = $this->newTitle;
        $this->changed = true;
    }

    public function gantiJudulPaksa()
    {
        $this->emit('tambahkonter');
    }

    public function render()
    {
        return view('livewire.judul-form');
    }
}
