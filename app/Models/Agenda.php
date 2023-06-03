<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $guarded =  [
        'id'
    ];

    protected $fillable = [
        'agenda_name',
        'date',
        'start_time',
        'end_time',
        'description'
    ];

    protected $dates = [
        'date',
    ];
}
