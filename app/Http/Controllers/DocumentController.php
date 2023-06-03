<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentRequest;

class DocumentController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new Document();
    }
    //
    public function adminIndex()
    {
        $title = 'Kelola dokumen';
        $docs = $this->model->all();

        return view('Admin.manage-document', compact('title', 'docs'));
    }

    public function create(Request $request)
    {
        $title = 'Tambahkan dokumen';

        return view('Document.create', compact('title'));
    }

    public function store(StoreDocumentRequest $request)
    {
        // File handling
        $file = $request->file('file');
        $file_name = Str::slug($request->title) . now()->getTimestamp() . '.' . $file->extension();
        $folder = "document";
        $file->storeAs($folder, $file_name);

        // Store to model
        $input = $request->validated();

        $input['file'] = "$folder/$file_name";

        $this->model->create($input);

        return to_route('document.admin.index')->with('created', "Sukses menyimpan dokumen");
    }
}
