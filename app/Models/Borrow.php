<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Tool::class, 'inventory_id', 'inventory_unique');
    }

    public function verificator()
    {
        return $this->belongsTo(User::class, 'verificator_id', 'id');
    }

    public function returning()
    {
        return $this->hasOne(Returning::class);
    }

    public function scopeSummaryOfAll(Builder $query)
    {
        return $query->select('id', 'user_id', 'purpose', 'inventory_id', 'start_borrow_date', 'expected_return_date', 'status', 'verified_at')->with(['user:id,name', 'inventory:inventory_unique,name'])->orderByDesc('created_at')->get();
    }

    public function scopeApiSummary(Builder $query, $limit, $offset)
    {
        return $query
            ->select('id', 'user_id', 'purpose', 'inventory_id', 'start_borrow_date', 'expected_return_date', 'status', 'verified_at')
            ->with(['user:id,name', 'inventory:inventory_unique,name'])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    public function scopeNotif(Builder $query)
    {
        return $query->select('id', 'user_id', 'purpose', 'inventory_id', 'status', 'created_at')->with(['user:id,name', 'inventory:inventory_unique,name'])->where('status', 'pending')->get();
    }

    public function scopeOfTool(Builder $query, $toolId)
    {
        return $query->select(
            'id',
            'user_id',
            'inventory_id',
            'purpose',
            'start_borrow_date',
            'expected_return_date',
            'actual_return_date',
            'status',
            'after_condition',
            DB::raw("CASE 
        WHEN actual_return_date IS NULL THEN 'not returned'
        WHEN actual_return_date > expected_return_date THEN 'overdue'
        ELSE 'on time'
    END AS status_peminjaman")
        )
            ->where('inventory_id', $toolId)
            ->where('status', 'accepted')
            ->orWhere('status', 'returned')
            ->with('user:id,name')
            ->orderByDesc('created_at');
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
            ->with('user:id,name')
            ->get();
    }
}
