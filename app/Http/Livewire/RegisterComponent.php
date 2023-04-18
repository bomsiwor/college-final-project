<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Profession;
use App\Models\Institution;
use App\Models\StudyProgram;
use App\Services\RegisterService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    // Personal information
    public $name;
    public $email;
    public $username;
    public $password;
    public $position;
    public $prodi;
    public $nip;
    public $nim;
    public $unit;

    // Institution information
    public $institution = 1;
    public $institutionName;
    public $institutionAddress;

    // Additional information
    public $acceptTerms;
    public $wargaCheck = false;
    public $profession_id = 1;
    public $identifier;
    public $identification_number;

    protected $rules = [
        'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
        'email' => 'required|email:dns|unique:users,email',
        'username' => 'required',
        'password' => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        'nim' => 'required_if:position,mahasiswa|unique:users,identification_number',
        'nip' => 'required_if:position,staff,dosen|unique:users,identification_number',
        'institutionName' => 'required_if:institution,other',
        'institutionAddress' => 'required_if:institution,other',
        'acceptTerms' => 'accepted',
        'prodi' => 'nullable',
        'unit' => 'nullable',
        'identifier' => 'nullable',
        'identification_number' => 'nullable',
        'institution_id' => 'nullable',
        'profession_id' => 'nullable'
    ];

    public function submit(RegisterService $service): void
    {
        $data = $this->validate();

        $identifier = [
            'intern_check' => $this->wargaCheck,
            'position' => $this->position
        ];

        $service->register($data, $identifier);
    }

    public function render()
    {
        $data = [
            'professions' => Profession::all(),
            'units' => DB::table('units')->get(),
            'institutions' => Institution::all(),
            'study_program' => StudyProgram::all()
        ];

        return view('livewire.register-component', $data);
    }
}
