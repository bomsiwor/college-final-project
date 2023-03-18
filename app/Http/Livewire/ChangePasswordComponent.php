<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ChangePasswordComponent extends Component
{
    public $currentpwd, $newpwd, $newpwd_confirmation;
    public $pwdChanged = false;

    protected $rules = [
        'currentpwd' => 'required_with:newpwd|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|current_password',
        'newpwd' => 'required_with:currentpwd|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed'
    ];

    protected $validationAttributes = [
        'currentpwd' => 'Kata sandi sekarang',
        'newpwd' => 'Kata sandi baru'
    ];

    public function submit()
    {
        $this->pwdChanged = false;
        $this->validate();

        User::where('id', auth()->user()->id)->update([
            'password' => $this->newpwd
        ]);

        $this->reset();
        $this->pwdChanged = true;
    }

    public function render()
    {
        return view('livewire.change-password-component');
    }
}
