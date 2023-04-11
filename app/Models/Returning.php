<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returning extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'returning_date' => 'datetime'
    ];

    public function verificator()
    {
        return $this->belongsTo(User::class, 'verificator_id', 'id');
    }
}
