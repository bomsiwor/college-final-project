<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyMaintenance extends FormRequest
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
            'actual_date' => 'required|before_or_equal:today',
            'operation_note' => 'nullable',
            'is_done' => 'required',
            'document' => 'required|mimes:pdf,jpg,png'
        ];
    }

    public function attributes()
    {
        return [
            'actual_date' => 'Tanggal pelaksanaan',
            'is_done' => 'Tanda selesai',
            'document' => 'Dokumen perawatan'
        ];
    }

    public function messages()
    {
        return [
            'actual_date' => [
                'before_or_equal' => ':attribute harus diisi sebelum atau hari ini',
                'required' => ':attribute harus diisi'
            ]
        ];
    }
}
