<?php

namespace App\Models\Person;

use App\Models\Institution;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extern extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
