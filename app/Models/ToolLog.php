<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolLog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'additional' => 'array',
        'log_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function inventory()
    {
        return $this->belongsTo(Tool::class, 'inventory_id', 'inventory_unique');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
