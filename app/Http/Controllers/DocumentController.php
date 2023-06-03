<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new Document();
    }
    //
    public function show(Document $document)
    {
        $title = 'Detail - ' . $document->title;

        return view('Document.show', compact('title', 'document'));
    }

    public function download(Request $request)
    {
        $data = $this->model->find($request->id);

        return Storage::download($data->file);
    }

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

    public function edit(Document $document)
    {
        $title = 'Edit dokumen';

        return view('Document.edit', compact('title', 'document'));
    }

    public function update(UpdateDocumentRequest $request)
    {
        $this->model->where('id', $request->id)->update($request->validated());

        return to_route('document.admin.index')->with('created', "Sukses mengupdate dokumen");
    }

    public function updateStatus(Request $request)
    {
        $data = $this->model->find($request->id);

        $data->update([
            'status' => $request->status
        ]);

        return to_route('document.admin.index')->with('created', "Status dokumen ID-$data->id diubah!");
    }

    public function destroy(Request $request)
    {
        $data = $this->model->find($request->id);

        Storage::delete($data->file);

        $data->delete();

        return to_route('document.admin.index')->with('deleted', "Berhasil menghapus dokumen");
    }
}
