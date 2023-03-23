<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $dates = ['updated_at', 'purchase_date'];

    public function scopeSummary(Builder $query)
    {
        return $query->select('name', 'merk', 'series', 'condition', 'status', 'inventory_number')->orderBy('purchase_date', 'desc')->get();
    }
}
