<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    protected $dates = ['attendance_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeStatistic(Builder $query)
    {
        $query->selectRaw('occupation as name, count(*) as value')->groupBy('occupation')->get();
    }

    public function scopeRecent(Builder $query)
    {
        $query->orderBy('attendance_time', 'desc')->with('user:id,name');
    }
}
