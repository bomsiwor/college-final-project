<?php

namespace App\Http\Livewire;

use App\Models\Borrow;
use Livewire\Component;

class NotificationComponent extends Component
{
    public $notif;

    public function loadData()
    {
        $this->notif = Borrow::notif();
    }

    public function render()
    {
        return view('livewire.notification-component');
    }
}
