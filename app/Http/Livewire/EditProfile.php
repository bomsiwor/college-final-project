<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class EditProfile extends Component
{
    use WithFileUploads;

    public $name, $description, $address, $phone, $identification_number, $identifier, $email, $photo;
    public $changed = false;
    public $idUser;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->description = $user->description;
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->identifier = $user->identifier;
        $this->identification_number = $user->identification_number;
        $this->email = $user->email;

        $this->idUser = $user->id;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:512', // 1MB Max
        ]);
    }

    public function submit()
    {
        $this->changed = false;
        $data = $this->validate([
            'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
            'description' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable',
            'identifier' => 'required',
            'identification_number' => ['required', Rule::unique('users')->ignore($this->idUser)],
            'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($this->idUser)]
        ]);

        User::where('id', $this->idUser)->update($data);

        $this->changed = true;
    }
    public function render()
    {
        return view('livewire.edit-profile');
    }
}
