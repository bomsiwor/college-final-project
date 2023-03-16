<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profession;
use App\Models\Institution;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RegisterComponent extends Component
{
    public $firstName, $lastName, $email, $username, $password, $wargaCheck, $position, $nip, $nim, $acceptTerms;
    public $notif = false;

    protected $rules = [
        'firstName' => 'required|min:4',
        'lastName' => 'nullable|min:4|regex:/^[a-zA-Z_ ]*$/',
        'email' => 'required|email:dns|unique:users,email',
        'username' => 'required',
        'password' => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        'nim' => 'required_if:position,mahasiswa',
        'nip' => 'required_if:position,staff,dosen',
        'acceptTerms' => 'accepted'
    ];

    protected $messages = [
        'firstName.min' => 'Tidak boleh terlalu pendek',
        'lastName.regex' => 'Tidak valid',
        'password.regex' => 'Tidak valid',
    ];

    protected $validationAttributes = [
        'firstName' => 'Nama depan',
        'username' => 'Username',
        'email' => 'Surel',
        'password' => 'Kata Sandi',
    ];

    public function submit()
    {
        $this->validate();

        return redirect(route('login'))->with('registerSuccess');
    }

    public function render()
    {
        $data = [
            'professions' => Profession::all(),
            'units' => DB::table('units')->get(),
            'institutions' => Institution::all()
        ];

        return view('livewire.register-component', $data);
    }
}
