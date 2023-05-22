<?php

namespace App\Http\Livewire\Admin;

use App\Models\Borrow;
use Livewire\Component;

class ToolBorrow extends Component
{
    public $data;

    public function loadData()
    {
        $this->data = Borrow::forAdmin();
    }

    public function render()
    {
        return view('livewire.admin.tool-borrow');
    }
}
