<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    // Accessor
    protected function startTime(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->isoFormat('HH:mm')
        );
    }

    protected function endTime(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->isoFormat('HH:mm')
        );
    }


    // Scope
    public function scopeTodayEvent(Builder $query)
    {
        return $query
            ->select('agenda_name', 'start_time', 'end_time')
            ->where('date', '=', today())
            ->orderBy('start_time')
            ->get();
    }
}
