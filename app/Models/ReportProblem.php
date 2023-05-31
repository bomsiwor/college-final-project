<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProblem extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'user_id',
        'description',
        'condition',
        'status',
        'tool_id',
        'verificator_id',
        'verified_at',
        'accessed',
        'analysis',
        'analyst_id',
        'analyzed_at',
        'advance_in_charge',
        'advance_operator',
        'advance_description',
        'advance_target',
        'repair_in_charge',
        'repair_operator',
        'repair_description',
        'repair_target',
        'supervisor_note',
        'effective_status'
    ];

    protected $dates = [
        'verified_at',
        'analyzed_at',
        'advance_target',
        'repair_target'
    ];

    protected $casts = [
        'analyzed_at' => 'datetime',
        // 'verfified_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verificator()
    {
        return $this->belongsTo(User::class, 'verificator_id', 'id');
    }

    public function analyst()
    {
        return $this->belongsTo(User::class, 'analyst_id', 'id');
    }

    // Scope
    public function scopeSummary(Builder $query)
    {
        return $query
            ->select('id', 'user_id', 'tool_id', 'condition', 'status', 'created_at')
            ->with('user:id,name', 'tool:id,name,inventory_number')
            ->get();
    }
}
