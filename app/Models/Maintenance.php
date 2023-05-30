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

    protected $fillable = [
        'activity_name',
        'agenda',
        'in_charge',
        'month',
        'document',
        'actual_date',
        'is_done',
        'operation_note'
    ];

    protected $dates = [
        'month',
        'actual_date'
    ];


    public function scopeSummary(Builder $query)
    {
        return $query->select('id', 'activity_name', 'is_done', 'in_charge', 'month')->get();
    }

    public function scopeApiSummary(Builder $query, $limit, $offset)
    {
        return $query->select('id', 'activity_name', 'is_done', 'in_charge', 'month')->limit($limit)->offset($offset)->get();
    }
}
