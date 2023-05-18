<?php

namespace App\Http\Livewire\Activity;

use Livewire\Component;
use App\Models\Attendance;

class AttendanceForm extends Component
{
    public $occupation, $description;

    protected $rules = [
        'occupation' => 'required'
    ];

    public function submit()
    {
        $this->validate();
        try {
            $data = [
                'occupation' => $this->occupation,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'attendance_time' => now()
            ];

            Attendance::create($data);
        } catch (\Throwable $e) {
            $this->addError('failed', 'Data gagal disimpan!');
            return;
        }
        $this->dispatchBrowserEvent('attendance-stored');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.activity.attendance-form');
    }
}
