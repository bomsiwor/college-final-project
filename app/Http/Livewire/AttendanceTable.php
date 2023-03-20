<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Database\Query\Builder;


class AttendanceTable extends Component
{

    public $attendances, $idUser;

    protected $listeners = [
        'addedPresensi' => 'loadData'
    ];

    public function loadData()
    {
        if (!$this->idUser) :
            return $this->attendances = Attendance::orderByDesc('attendance_time')->limit(5)->with('user:id,name')->get();

        endif;
        $this->attendances = Attendance::where('user_id', $this->idUser)->orderBy('attendance_time', 'desc')->with('user:id,name')->get();
    }

    public function render()
    {
        return view('livewire.attendance-table');
    }
}
