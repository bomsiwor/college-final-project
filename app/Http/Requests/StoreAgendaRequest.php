<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendaRequest extends FormRequest
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
            'agenda_name' => 'required',
            'date' => 'required|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'description' => 'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'agenda_name' => 'Nama kegiatan',
            'date' => 'Tanggal',
            'start_time' => 'Waktu mulai',
            'end_time' => 'Waktu selesai'
        ];
    }
}
