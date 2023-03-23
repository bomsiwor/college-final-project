<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $data;

    public function loadData()
    {
        $this->data = User::with(['institution:id,institution_name', 'profession'])->get();
    }

    public function render()
    {
        return view('livewire.admin.user-list');
    }
}
