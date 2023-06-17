<?php

namespace App\Http\Livewire\Tool;

use App\Models\Tool;
use App\Models\Borrow;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BorrowComponent extends Component
{
    public $toolId, $data;

    public function loadData()
    {
        $this->data = Borrow::ofTool($this->toolId)->get();
        // dd($this->data->inventory);
    }

    public function render()
    {
        return view('livewire.tool.borrow-component');
    }
}
