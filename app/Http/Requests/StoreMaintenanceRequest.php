<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceRequest extends FormRequest
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
            'activity_name.0' => 'required|min:5',
            'agenda.0' => 'required|min:10',
            'in_charge.0' => 'required|min:5',
            'month.0' => 'required|after_or_equal:today',

            'activity_name.1' => 'nullable',
            'agenda.1' => 'nullable|required_with:activity_name.1|min:10',
            'in_charge.1' => 'nullable|required_with:activity_name.1|min:5',
            'month.1' => 'nullable|required_with:activity_name.1|after_or_equal:today',

            'activity_name.2' => 'nullable',
            'agenda.2' => 'nullable|required_with:activity_name.2|min:10',
            'in_charge.2' => 'nullable|required_with:activity_name.2|min:5',
            'month.2' => 'nullable|required_with:activity_name.2|after_or_equal:today',

            'activity_name.3' => 'nullable',
            'agenda.3' => 'nullable|required_with:activity_name.3|min:10',
            'in_charge.3' => 'nullable|required_with:activity_name.3|min:5',
            'month.3' => 'nullable|required_with:activity_name.3|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'activity_name.0' => 'Nama Kegiatan #:position',
            'agenda.0' => 'Rincian #:position',
            'in_charge.0' => 'Penanggungjawab kegiatan #:position',
            'month.0' => 'Rencana pelaksanaan kegiatan #:position',

            'activity_name.1' => 'Nama kegiatan #:position',
            'agenda.1' => 'Rincian #:position',
            'in_charge.1' => 'Penanggungjawab kegiatan #:position',
            'month.1' => 'Rencana pelaksanaan kegiatan #:position',

            'activity_name.2' => 'Nama kegiatan #:position',
            'agenda.2' => 'Rincian #:position',
            'in_charge.2' => 'Penanggungjawab kegiatan #:position',
            'month.2' => 'Rencana pelaksanaan kegiatan #:position',

            'activity_name.3' => 'Nama kegiatan #:position',
            'agenda.3' => 'Rincian #:position',
            'in_charge.3' => 'Penanggungjawab kegiatan #:position',
            'month.3' => 'Rencana pelaksanaan kegiatan #:position',
        ];
    }
}
