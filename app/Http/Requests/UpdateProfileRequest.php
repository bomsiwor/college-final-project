<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
            'description' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable',
            'identification_number' => ['required', Rule::unique('users', 'identification_number')->ignore(auth()->user()->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
            'profile_picture' => 'image|max:1024'
        ];
    }
}
