<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    private $data;

    public function register(array $validatedData, array $identifier): RedirectResponse
    {
        $credentials = [
            'name' => ucwords($validatedData['name']),
            'email' => $validatedData['email'],
            'password' => Hash::make(['password']),
            'username' => $validatedData['username'],
        ];

        switch ($identifier['intern_check']) {
            case 'yes':
                switch ($identifier['position']) {
                    case 'dosen':
                        $this->data = $this->createLecturerAccount(
                            $credentials,
                            $validatedData['nip']
                        );
                        $role = 'lecturer';
                        break;
                    case 'mahasiswa':
                        $this->data = $this->createStudentAccount(
                            $credentials,
                            $validatedData['nim'],
                            $validatedData['prodi']
                        );
                        $role = 'student';
                        break;
                    case 'staff':
                        $this->data = $this->createStaffAccount(
                            $credentials,
                            $validatedData['nip'],
                            $validatedData['unit']
                        );
                        $role = 'staff';
                        break;
                }
                break;

            case 'no':
                $externIdentifier = ['identifier', 'institution', 'profession_id', 'identification_number'];
                $this->data = $this->createExternAccount(
                    $credentials,
                    array_intersect_key($validatedData, $externIdentifier)
                );
                $role = 'extern';
                break;
        }

        $user = User::create($this->data);
        $user->assignRole('user');
        $user->assignRole($role);

        return redirect(route('login'))->with('registerSuccess');
    }

    public function createLecturerAccount($userData, $nip)
    {
        return $userData += [
            'identifier' => 'NIP',
            'identification_number' => $nip,
            'profession_id' => '64',
            'institution_id' => '1'
        ];
    }

    public function createStudentAccount($userData, $nim, $prodi)
    {
        return $userData += [
            'identifier' => 'NIM',
            'identification_number' => $nim,
            'profession_id' => '3',
            'study_program_id' => $prodi,
            'institution_id' => '1'
        ];
    }

    public function createStaffAccount($userData, $nip, $unit)
    {
        return $userData += [
            'identifier' => 'NIP',
            'identification_number' => $nip,
            'profession_id' => '5',
            'unit_id' => $unit,
            'institution_id' => '1'
        ];
    }

    public function createExternAccount($userData, array $externData)
    {
        return $userData += [
            'identifier' => $externData['identifier'],
            'identification_number' => $externData['identification_number'],
            'profession_id' => $externData['profession_id'],
            'institution_id' => $externData['institution']
        ];
    }
}
