<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Query\Builder;

class AttendanceTable extends Component
{
    public $attendances;
    public $idUser;
    public $pagination = false;

    protected $listeners = [
        'addedPresensi' => 'loadData'
    ];

    public function loadData()
    {
        if (!$this->idUser) :
            return $this->attendances = Attendance::recent()->limit(5)->get();
        endif;
        $this->attendances = Attendance::where('user_id', $this->idUser)->recent()->get();
    }

    public function render()
    {
        return view('livewire.attendance-table');
    }
}
