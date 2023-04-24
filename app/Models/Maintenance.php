<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'month',
        'actual_date'
    ];


    public function scopeSummary(Builder $query)
    {
        return $query->select('id', 'activity_name', 'is_done', 'in_charge', 'month')->get();
    }
}
