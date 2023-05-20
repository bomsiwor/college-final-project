<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioactiveBorrow extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'start_borrow_date',
        'expected_return_date',
        'actual_return_date',
        'verified_at'
    ];

    // Part of ORM

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function radioactive()
    {
        return $this->belongsTo(Radioactive::class, 'inventory_id', 'inventory_unique');
    }

    public function verificator()
    {
        return $this->belongsTo(User::class, 'verificator_id', 'id');
    }

    // Part of scoped
    public function scopeSummaryOfAll(Builder $query)
    {
        return $query->select(
            'id',
            'user_id',
            'purpose',
            'inventory_id',
            'start_borrow_date',
            'expected_return_date',
            'status',
            'verified_at'
        )
            ->with(['user:id,name', 'radioactive:inventory_unique,entry_number,element_name,isotope_number'])
            ->orderByDesc('created_at')->get();
    }
}
