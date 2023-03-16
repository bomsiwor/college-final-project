<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $displayed = false;

    protected $listeners = [
        'tambahkonter' => 'addSeribu',
        'addmapuluh' => 'tambahmapuluh'
    ];

    public function increment()
    {
        $this->count++;
    }

    public function resetCount()
    {
        $this->count = 0;
    }

    public function addSeribu()
    {
        $this->count += 1000;
    }

    public function tambahmapuluh()
    {
        $this->count += 50;
    }

    public function munculkan()
    {
        $this->displayed = !$this->displayed;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
