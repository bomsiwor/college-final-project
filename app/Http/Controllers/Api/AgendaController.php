<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public $limit = 30;
    public $offset = 0;

    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $agenda = Agenda::limit($this->limit)->offset($this->offset)->get();

        return response()->success([
            'tools' => $agenda,
            'limit' => $this->limit,
            'offset' => $this->offset
        ]);
    }
}
