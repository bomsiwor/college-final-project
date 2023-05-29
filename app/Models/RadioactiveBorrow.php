<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function returning()
    {
        return $this->hasOne(RadioactiveReturning::class);
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

    // For API
    public function scopeApiSummary(Builder $query, int $limit, int $offset)
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
            ->orderByDesc('created_at')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    public function scopeForAdmin(Builder $query)
    {
        return $query->select(
            'id',
            'user_id',
            'inventory_id',
            'start_borrow_date',
            'expected_return_date',
            DB::raw("CASE 
        WHEN expected_return_date > NOW() THEN 'not late'
        WHEN expected_return_date <= NOW() THEN 'overdue'
        END AS status_peminjaman")
        )
            ->where('status', 'accepted')
            ->whereNull('actual_return_date')
            ->with('user:id,name', 'radioactive:inventory_unique,element_name,isotope_number,entry_number')
            ->get();
    }
}
