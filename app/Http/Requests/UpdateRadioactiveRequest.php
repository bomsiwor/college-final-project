<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRadioactiveRequest extends FormRequest
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
            'element_name' => 'required',
            'isotope_number' => 'required',
            'element_symbol' => 'required',
            'purchase_date' => 'nullable',
            'manufacturing_date' => 'required|before:today',
            'initial_activity' => 'required|numeric|min:0.001',
            'packaging_type' => 'required',
            'condition' => 'required',
            'properties' => 'required',
            'description' => 'nullable',
            'inventory_number' => 'nullable',
            'quantity' => 'required|numeric|min:0',
            'entry_number' => [
                'required',
                'numeric',
                'min:1',
                Rule::unique('radioactives', 'entry_number')->ignore($this->entry_number)
            ]
        ];
    }

    public function attributes()
    {
        return [
            'element_name' => 'Nama element',
            'isotope_number' => 'Nomor isotop',
            'element_symbol' => 'Simbol element',
            'purchase_date' => 'Tanggal pembelian/pengadaan',
            'manufacturing_date' => 'Tanggal pembuatan',
            'initial_activity' => 'Aktivitas awal',
            'packaging_type' => 'Tipe Bungkusan',
            'condition' => 'Kondisi',
            'properties' => 'Sifat unsur',
            'description' => 'Keterangan',
            'inventory_number' => 'Nomor Inventaris',
            'quantity' => 'Jumlah',
            'entry_number' => 'Nomor urut sumber'
        ];
    }
}
