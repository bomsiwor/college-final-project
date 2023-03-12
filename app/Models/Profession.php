<?php

namespace App\Models;

use App\Models\Person\Extern;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    public function extern()
    {
        return $this->hasMany(Extern::class);
    }
}
