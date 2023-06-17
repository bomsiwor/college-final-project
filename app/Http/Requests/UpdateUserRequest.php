<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'identifier' => 'required',
            'identification_number' => 'required',
            'profession_id' => 'required',
            'institution_id' => 'required',
            'study_program_id' => 'nullable',
            'unit_id' => 'nullable'
        ];
    }
}
