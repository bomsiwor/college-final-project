<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Profession;
use App\Models\Institution;
use App\Models\Person\Lecturer;
use App\Models\Person\Staff;
use App\Models\Person\Student;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    public $name, $email, $username, $password, $wargaCheck, $position, $nip, $nim, $acceptTerms, $prodi;
    public $institution, $institutionName, $institutionAddress;

    protected $rules = [
        'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
        'email' => 'required|email:dns|unique:users,email',
        'username' => 'required',
        'password' => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        'nim' => 'required_if:position,mahasiswa',
        'nip' => 'required_if:position,staff,dosen',
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

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        switch ($this->position) {
            case 'dosen':
                $this->registerDosen($user->id);
                $user->assignRole('lecturer');
                break;
            case 'mahasiswa':
                $this->registerMahasiswa($user->id);
                $user->assignRole('student');
                break;
            case 'staff':
                $this->registerStaff($user->id);
                $user->assignRole('staff');
                break;
        }

        return redirect(route('login'))->with('registerSuccess');
    }

    public function registerDosen($user_id)
    {

        Lecturer::create([
            'user_id' => $user_id,
            'lecturer_name' => ucwords($this->name),
            'nip' => $this->nip
        ]);
    }

    public function registerMahasiswa($user_id)
    {
        Student::create([
            'user_id' => $user_id,
            'student_name' => ucwords($this->name),
            'nim' => $this->nim,
            'study_program_id' => $this->prodi
        ]);
    }

    public function registerStaff($user_id)
    {
        Staff::create([
            'user_id' => $user_id,
            'staff_name' => ucwords($this->name),
            'unit_id' => $this->unit,
            'nip' => $this->nip
        ]);
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
