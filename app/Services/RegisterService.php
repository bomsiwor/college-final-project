<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profession;
use App\Models\Institution;
use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterService
{
    private $data;

    public function handle(Request $request)
    {
        $this->data = $request->all();

        $credentials = $this->validateCredentials($this->data);

        $occupations = $this->checkOccupation($this->data);

        $jobs = $this->addJobsAndInstitution($occupations);

        $identifier = $this->checkIdentifier($this->data);

        $finalData = array_merge($credentials, $occupations, $jobs, $identifier);

        $user = $this->register($finalData);

        return response()->json([
            'code' => 200,
            'message' => 'Pendaftaran sukses',
            'data' => $user
        ]);
    }

    private function register($data)
    {
        try {
            $user = User::create($data);
        } catch (\Throwable $e) {
            return throw new HttpResponseException(response()->json([
                'code' => 403,
                'message' => $e->getMessage(),
                'data' => 'error'
            ]));
        }

        return $user;
    }

    private function validateCredentials(array $data)
    {
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|min:4|regex:/^[a-zA-Z_ ]*$/',
                'email' => [
                    'required',
                    'email',
                    'unique:users'
                ],
                'password' => 'required|min:6'
            ]
        );

        $validated = $validator->validated();

        if ($validator->fails()) :
            return throw new HttpResponseException(response()->json([
                'code' => 403,
                'message' => 'Validasi gagal!',
                'data' => $validator->errors(),
            ], 403));
        endif;

        $validated['username'] = $validated['name'] . now()->timestamp;
        $validated['password'] = Hash::make($validated['password']);

        return $validated;
    }

    private function checkOccupation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'is_internal' => 'required|boolean',
                'position' => [
                    'required',
                    Rule::in(($data['is_internal'] == 1 ? ['mahasiswa', 'dosen', 'staff'] : ['bekerja', 'tidak bekerja']))
                ],
            ]
        );

        if ($validator->fails()) :
            return $this->errorValidation('Validasi gagal!', $validator->errors());
        endif;

        return $validator->validated();
    }

    private function addJobsAndInstitution($data)
    {

        if ((bool)$data['is_internal']) :
            $jobs = $this->intern($data['position']);
        else :

            $jobs = $this->extern($data['position']);
        endif;

        return $jobs;
    }

    private function intern(string $position)
    {
        $data = [
            'institution_id' => 1
        ];

        switch ($position) {
            case 'dosen':
                $data['profession_id'] = 64;
                break;

            case 'mahasiswa':
                $data['profession_id'] = 3;
                $data['study_program_id'] = $this->handleStudent($this->data);
                break;

            case 'staff':
                $data['profession_id'] = 5;
                $data['unit_id'] = $this->handleStaff($this->data);
                break;
        }

        return $data;
    }

    private function extern(string $position)
    {
        $data = [];
        if ($position == 'tidak bekerja') :
            $data['profession_id'] = 1;
            return $data;
        endif;

        $idProfession = Profession::select('id')->get()->pluck('id');

        $validator = Validator::make(
            $this->data,
            [
                'profession_id' => [
                    'required',
                    Rule::in($idProfession)
                ],
                'institution_id' => 'required'
            ]
        );

        if ($validator->fails()) :
            return throw new HttpResponseException(response()->json([
                'code' => 403,
                'message' => 'Data pekerjaan tidak valid',
                'data' => $validator->errors()
            ], 403));
        endif;

        $validated = $validator->validated();

        $validated['institution_id'] = $this->checkInstitution($validated['institution_id']);

        $data += $validated;

        return $data;
    }

    private function handleStudent($data)
    {
        $validator = Validator::make(
            $this->data,
            [
                'study_program_id' => 'required|numeric|min:1|max:3',
            ]
        );

        if ($validator->fails()) :
            return $this->errorValidation("Program studi harus diisi!", $validator->errors());
        endif;

        return ($validator->validated())['study_program_id'];
    }

    private function handleStaff($data)
    {
        $units = Unit::select('id')->get()->pluck('id');

        $validator = Validator::make(
            $this->data,
            [
                'unit_id' => [
                    'required',
                    'numeric',
                    Rule::in($units)
                ],
            ]
        );

        if ($validator->fails()) :
            return $this->errorValidation("Unit harus diisi!", $validator->errors());
        endif;

        return ($validator->validated())['unit_id'];
    }

    public function checkInstitution($data)
    {
        if ($data == 'other') :
            $validator = Validator::make($this->data, [
                'institution_name' => 'required',
                'institution_address' => 'required'
            ]);

            $result = Institution::create($validator->validated());

            return $result->id;
        endif;

        if (!Institution::select('id')->where('id', $data)->first()) :
            return $this->errorValidation('ID tidak ditemukan', [
                'ID Institusi tidak ditemukan',
                "Isi institusi dengan 'other'",
                'Tambahkan parameter institution_name (string) & institution_address (string)'
            ]);
        endif;

        return $data;
    }

    private function checkIdentifier($data)
    {
        if ($data['position'] == 'mahasiswa') :
            $identifier = 'nim';
        elseif ($data['position'] == 'dosen' || $data['position'] == 'staff') :
            $identifier = 'nip';
        else :
            $identifier = [
                'ktp',
                'sim',
                'nip',
                'nim',
                'nis',
                'paspor',
                'kia'
            ];
        endif;

        $data['identifier'] = isset($data['identifier']) ? strtolower($data['identifier']) : null;

        $validator = Validator::make($data, [
            'identifier' => [
                'required',
                Rule::in($identifier)
            ],
            'identification_number' => [
                'required',
                'numeric',
                'min_digits:4',
                'unique:users'
                // 'unique:users,identification_number'
            ]
        ]);

        if ($validator->fails()) :
            return $this->errorValidation("Identitas tidak valid", $validator->errors());
        endif;

        $validated = $validator->validated();

        $validated['identifier'] = Str::upper($validated['identifier']);

        return $validated;
    }

    private function errorValidation(string $message, $data = [], int $code = 403,)
    {
        return throw new HttpResponseException(response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code));
    }
}
