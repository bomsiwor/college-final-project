<?php

namespace App\Models;

use App\Models\Person\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
