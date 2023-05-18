<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiationLog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'log_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
