<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder;

class AttendanceCount extends Component
{
    public $count;
    protected $listeners = [
        'addedPresensi' => 'mount'
    ];

    public function mount()
    {
        $this->count = Attendance::where('user_id', auth()->user()->id)->count();
    }

    public function render()
    {
        return view('livewire.attendance-count');
    }
}
