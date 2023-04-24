<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


class GetNuclideAction
{

    public function handle(string $slug, string $field): Collection
    {
        $response = Http::get("https://www-nds.iaea.org/relnsd/v1/data?fields=levels&nuclides=$slug");
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

        return $response;
    }
}
