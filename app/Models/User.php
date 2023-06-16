<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\IdentifierEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'identifier',
        'identification_number',
        'address',
        'phone',
        'profile_picture',
        'institution_id',
        'profession_id',
        'unit_id',
        'study_program_id',

        'github_id',
        'linkedin_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        // 'identifier' => IdentifierEnum::class
    ];


    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function borrow()
    {
        return $this->hasMany(Borrow::class);
    }

    public function returning()
    {
        return $this->hasMany(Returning::class, 'verificator_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function toolLog()
    {
        return $this->hasMany(ToolLog::class);
    }

    public function radiation()
    {
        return $this->hasMany(RadiationLog::class);
    }
}
