<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditProfile extends Component
{
    use WithFileUploads;

    public $name, $description, $address, $phone, $identification_number, $identifier, $email, $photo;
    public $changed = false;
    public $idUser;

    protected $listeners = [
        'profileChanged' => '$refresh',
        'deletePhoto' => 'deletePhoto'
    ];

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

    public function deletePhoto()
    {
        Storage::delete(auth()->user()->profile_picture);
        $data['profile_picture'] = null;

        User::where('id', auth()->user()->id)->update($data);
        $this->emitSelf('profileChanged');
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

        if ($this->photo != null) :
            if (auth()->user()->profile_picture != null) :
                Storage::delete(auth()->user()->profile_picture);
            endif;

            $photo = $this->photo->store('photos');
            $data['profile_picture'] = $photo;
        endif;

        User::where('id', $this->idUser)->update($data);

        $this->changed = true;

        $this->emitSelf('profileChanged');
    }
    public function render()
    {
        return view('livewire.edit-profile');
    }
}
