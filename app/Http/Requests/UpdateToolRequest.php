<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToolRequest extends FormRequest
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
            'inventory_number' => 'required',
            'merk' => 'required',
            'series' => 'required',
            'condition' => 'required',
            'used_status' => 'required',
            'purchase_date' => 'required|before_or_equal:today',
            'price' => 'nullable|numeric|min:100',
            'images.*' => 'nullable|mimes:jpg,png|max:2048',
            'manual' => 'nullable|mimes:pdf|max:4096'
        ];
    }

    public function attributes()
    {
        return [
            'used_status' => 'Status penggunaan'
        ];
    }
}
