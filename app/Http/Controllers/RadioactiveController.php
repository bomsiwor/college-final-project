<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RadioactiveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:lecturer']);
    }

    public function index()
    {
        $title = 'Data ZRA';
        return view('Radioactive.index', compact('title'));
    }

    public function detail($isotopes)
    {
        $title = 'Detail ZRA';

        $response = Http::get("https://www-nds.iaea.org/relnsd/v1/data?fields=levels&nuclides=$isotopes");
        // $response = Http::get('https://www-nds.iaea.org/relnsd/v1/data?fields=levels&nuclides=60co');

        $response = explode("\n", $response->body());

        $header = explode(",", array_shift($response));

        $response = collect($response)->reject(function ($data) {
            return empty($data);
        })->map(function ($data) use ($header) {
            $data = explode(',', $data);
            // foreach ($header as $key => $value) :
            //     $data[$value] = $data[$key];
            //     unset($data[$key]);
            // endforeach;
            $data = array_combine($header, $data);

            return  $data;
        });

        return view('Radioactive.index', compact('title', 'response'));
    }
}
