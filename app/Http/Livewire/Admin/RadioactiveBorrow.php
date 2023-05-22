<?php

namespace App\Http\Livewire\Admin;

use App\Models\RadioactiveBorrow as ModelsRadioactiveBorrow;
use Livewire\Component;

class RadioactiveBorrow extends Component
{
    public $data;

    public function loadData()
    {
        $this->data = ModelsRadioactiveBorrow::forAdmin();
    }

    public function render()
    {
        return view('livewire.admin.radioactive-borrow');
    }
}
