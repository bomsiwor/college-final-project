<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Livewire\Component;

class AttendanceComponent extends Component
{
    public $occupation, $description;

    protected $listeners = [
        'isiPresensi' => 'logging'
    ];

    public function logging()
    {
        $data = [
            'occupation' => $this->occupation,
            'description' => $this->description,
            'user_id' => auth()->user()->id,
            'attendance_time' => now()
        ];

        Attendance::create($data);

        $this->emit('addedPresensi');
    }

    public function render()
    {
        return view('livewire.attendance-component');
    }
}
