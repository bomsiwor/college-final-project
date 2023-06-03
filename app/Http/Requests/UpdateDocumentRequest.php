<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
            'title' => 'required|min:5',
            'category' => 'required|min:5',
            'topic' => 'nullable|min:5|required_if:category,other',
            'description' => 'nullable|required_if:category,other',
            'file' => 'sometimes|file|mimetypes:application/pdf'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Judul dokumen',
            'file' => 'File',
            'category' => 'Kategori',
            'topic' => 'Topik'
        ];
    }
}
