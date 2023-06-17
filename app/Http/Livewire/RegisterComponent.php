<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Profession;
use App\Models\Institution;
use Illuminate\Support\Str;
use App\Models\StudyProgram;
use Illuminate\Validation\Rule;
use App\Services\RegisterService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    // Register steps
    public $currentStep;
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
    public $phone;

    // Institution information
    public $institution = 1;
    public $institution_name;
    public $institution_address;

    // Additional information
    public $acceptTerms;
    public $profession_id = 1;
    public $identifier;
    public $identification_number;
    public $data;
    public $wargaCheck;

    // protected $rules = [
    //     'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
    //     'email' => 'required|email:dns|unique:users,email',
    //     'username' => 'required',
    //     'password' => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
    //     'nim' => 'required_if:position,mahasiswa|unique:users,identification_number',
    //     'nip' => 'required_if:position,staff,dosen|unique:users,identification_number',
    //     'institutionName' => 'required_if:institution,other',
    //     'institutionAddress' => 'required_if:institution,other',
    //     'acceptTerms' => 'accepted',
    //     'prodi' => 'nullable',
    //     'unit' => 'nullable',
    //     'identifier' => 'nullable',
    //     'identification_number' => 'nullable',
    //     'institution_id' => 'nullable',
    //     'profession_id' => 'nullable'
    // ];

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;

        if ($this->currentStep > 4) :
            $this->currentStep = 4;
        endif;
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;

        if ($this->currentStep < 1) :
            $this->currentStep = 1;
        endif;
    }

    public function validateData()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6',
                ]);
                break;

            case 3:
                $this->validate([
                    'identifier' => 'required',
                    'identification_number' => 'required|numeric|min_digits:4',
                    'profession_id' => [
                        'nullable',
                        Rule::requiredIf(function () {
                            return ($this->position == 'work' ? true : false);
                        })
                    ],
                    'institution' => [
                        'nullable',
                        Rule::requiredIf(function () {
                            return ($this->position == 'work' ? true : false);
                        })
                    ],
                ]);
                break;

            default:

                break;
        }
    }

    public function changePosition(string $position)
    {
        $this->position = $position;
        $this->setProfession($position);

        $this->increaseStep();
    }

    public function setProfession($position)
    {
        switch ($position) {
            case 'lecturer':
                $this->profession_id = 64;
                $this->institution = 1;
                $this->identifier = 'NIP';
                break;

            case 'student':
                $this->profession_id = 3;
                $this->institution = 1;
                $this->identifier = 'NIM';
                break;

            case 'staff':
                $this->profession_id = 5;
                $this->institution = 1;
                $this->identifier = 'NIP';
                break;

            default:
                break;
        }
    }

    public function createData()
    {
        return $this->data =
            [
                'name' => Str::title($this->name),
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'username' => Str::lower($this->name . now()->timestamp),
                'identifier' => $this->identifier,
                'identification_number' => $this->identification_number,
                'phone' => $this->phone,
                'profession_id' => $this->profession_id,
                'institution_id' => $this->institution,
                'study_program_id' => ($this->prodi ?? null),
                'unit_id' => ($this->unit ?? null)
            ];
    }

    public function register()
    {
        $this->validate([
            'institution_name' => [
                'nullable',
                Rule::requiredIf(function () {
                    return ($this->institution == 'other' ? true : false);
                }),
                'min:5'
            ],
            'institution_address' => [
                'nullable',
                Rule::requiredIf(function () {
                    return ($this->institution == 'other' ? true : false);
                }),
                'min:5'
            ],
            'phone' => 'required|numeric|min_digits:8',
            'acceptTerms' => 'accepted'
        ]);

        if ($this->institution_address && $this->institution == 'other') :
            $this->institution = Institution::create([
                'institution_name' => $this->institution_name,
                'institution_address' => $this->institution_address
            ])->id;
        endif;

        try {
            $user = User::create($this->createData());

            $user->assignRole('user');
        } catch (\Throwable $e) {
            return $this->addError('failed', $e->getMessage());
        }

        return to_route('login')->with('registerSuccess', 'sukses');
    }

    public function render()
    {
        $data = [
            'professions' => Profession::all(),
            'units' => DB::table('units')->get(),
            'institutions' => Institution::where('id', '!=', 2)->get(),
            'study_program' => StudyProgram::all()
        ];

        return view('livewire.register-component', $data);
    }
}
