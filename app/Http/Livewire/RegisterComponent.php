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
    public $institution = 1;
    public $institutionName, $institutionAddress;
    public $wargaCheck = false;
    public $profession_id = 1;
    public $identifier, $identification_number;

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

    public function submit()
    {
        $this->validate();

        $userDetail = [
            'name' => ucwords($this->name),
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'username' => $this->username,
        ];

        switch ($this->wargaCheck) {
            case 'yes':
                switch ($this->position) {
                    case 'dosen':
                        $userDetail = $this->createLecturerAccount($userDetail);
                        $role = 'lecturer';
                        break;
                    case 'mahasiswa':
                        $userDetail = $this->createStudentAccount($userDetail);
                        $role = 'student';
                        break;
                    case 'staff':
                        $userDetail = $this->createStaffAccount($userDetail);
                        $role = 'staff';
                        break;
                }
                break;

            case 'no':
                $userDetail = $this->createExternAccount($userDetail);
                $role = 'extern';
                break;
        }

        $user = User::create($userDetail);
        $user->assignRole($role);
        $user->assignRole('user');

        return redirect(route('login'))->with('registerSuccess');
    }

    public function createLecturerAccount($userData)
    {
        return $userData += [
            'identifier' => 'NIP',
            'identification_number' => $this->nip,
            'profession_id' => '64',
            'institution_id' => '1'
        ];
    }

    public function createStudentAccount($userData)
    {
        return $userData += [
            'identifier' => 'NIM',
            'identification_number' => $this->nim,
            'profession_id' => '3',
            'study_program_id' => $this->prodi,
            'institution_id' => '1'
        ];
    }

    public function createStaffAccount($userData)
    {
        return $userData += [
            'identifier' => 'NIP',
            'identification_number' => $this->nip,
            'profession_id' => '5',
            'unit_id' => $this->unit,
            'institution_id' => '1'
        ];
    }

    public function createExternAccount($userData)
    {
        return $userData += [
            'identifier' => $this->identifier,
            'identification_number' => $this->identification_number,
            'profession_id' => $this->profession_id,
            'institution_id' => $this->institution
        ];
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
