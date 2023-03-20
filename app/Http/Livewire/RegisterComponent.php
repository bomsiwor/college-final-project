<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Profession;
use App\Models\Institution;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    public $name, $email, $username, $password, $position, $nip, $nim, $acceptTerms, $prodi, $unit;
    public $institution, $institutionName, $institutionAddress;
    public $wargaCheck = false;

    protected $rules = [
        'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
        'email' => 'required|email:dns|unique:users,email',
        'username' => 'required',
        'password' => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        'nim' => 'required_if:position,mahasiswa|unique:users,identification_number',
        'nip' => 'required_if:position,staff,dosen|unique:users,identification_number',
        'institutionName' => 'required_if:institution,other',
        'institutionAddress' => 'required_if:institution,other',
        'acceptTerms' => 'accepted'
    ];

    protected $validationAttributes = [
        'name' => 'Nama',
        'username' => 'Username',
        'email' => 'Surel',
        'password' => 'Kata Sandi',
        'nim' => 'NIM',
        'nip' => 'NIP',
        'position' => 'Posisi',
        'institution' => 'Instansi',
        'institutionName' => 'Nama instansi',
        'institutionAddress' => 'Alamat instansi',
    ];

    public function submit()
    {
        $this->validate();

        $userDetail = [
            'name' => ucwords($this->name),
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'username' => $this->username,
            'institution_id' => '1'
        ];

        switch ($this->position) {
            case 'dosen':
                $userDetail += [
                    'identifier' => 'NIP',
                    'identification_number' => $this->nip,
                    'profession_id' => '64'
                ];
                $role = 'lecturer';
                break;
            case 'mahasiswa':
                $userDetail += [
                    'identifier' => 'NIM',
                    'identification_number' => $this->nim,
                    'profession_id' => '3',
                    'study_program_id' => $this->prodi
                ];
                $role = 'student';
                break;
            case 'staff':
                $userDetail += [
                    'identifier' => 'NIP',
                    'identification_number' => $this->nip,
                    'profession_id' => '5',
                    'unit_id' => $this->unit
                ];
                $role = 'staff';
                break;
        }

        $user = User::create($userDetail);
        $user->assignRole($role);

        return redirect(route('login'))->with('registerSuccess');
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
