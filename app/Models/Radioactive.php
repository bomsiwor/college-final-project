<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Radioactive extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'manufacturing_date'
    ];

    public function scopeSummary(Builder $query)
    {
        return $query->select(
            'inventory_unique',
            'entry_number',
            'element_name',
            'isotope_number',
            'initial_activity',
            'status',
            'manufacturing_date'
        )->orderByDesc('manufacturing_date')->get();
    }

    protected function elementName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }
}
