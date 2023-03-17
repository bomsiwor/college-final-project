<?php

namespace App\Models\Person;

use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
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

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
