<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendaRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    //
    public $model;

    public function __construct()
    {
        $this->model = new Agenda();
    }

    public function index()
    {
        $title = "Agenda Laboratorium";

        $data = $this->model->all();

        return view('Dashboard.agenda', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Tambah data';

        return view('Agenda.create', compact('title'));
    }

    public function store(StoreAgendaRequest $request)
    {
        $this->model->create($request->validated());

        return to_route('agenda.index')->with('created', 'Sukses menambahkan agenda!');
    }
}
