<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->profile_picture) :
            if (auth()->user()->profile_picture) :
                Storage::delete(auth()->user()->profile_picture);
            endif;
            $file = $request->file('profile_picture');
            $imageExt = $file->getClientOriginalExtension();
            $imageName = auth()->user()->identification_number . rand(0, 999) . '.' .  $imageExt;
            $imagePath = $file->storeAs('photos', $imageName);
        else :
            $imagePath = null;
        endif;

        $data['profile_picture'] = $imagePath;

        try {
            User::where('id', auth()->id())->update($data);
        } catch (\Throwable $e) {
            abort(500);
        }

        return back()->with('success', 'sukses');
    }

    public function deletePhoto(Request $request)
    {
        if ($request->ajax()) :
            Storage::delete(auth()->user()->profile_picture);
            $data = User::find(auth()->id());
            $data->profile_picture = null;
            $data->save();

            return response()->json([
                'message' => 'success',
            ]);
        endif;
    }

    public function delete(Request $request, User $user)
    {
        $user->delete();

        return back()->with('success', 'Menghapus pengguna');
    }

    public function previlege($previlege)
    {
        $title = 'Kelola Previlege';
        $users = User::permission($previlege)
            ->select('id', 'name', 'institution_id', 'profession_id')
            ->with('institution:id,institution_name', 'profession:id,profession_name')
            ->get();

        return view('Admin.manageUserPermission', compact('users', 'title', 'previlege'));
    }

    public function updatePermission(Request $request)
    {
        $request->validate([
            'user_id' => 'exists:users,id'
        ]);

        $user = User::find($request->user_id);

        if ($request->operation == 'assign') :
            $user->givePermissionTo($request->previlege);
            $status = 'menambahkan';
        elseif ($request->operation == 'revoke') :
            $user->revokePermissionTo($request->previlege);
            $status = 'menghapus';
        else :
            abort(404);
        endif;

        $message = "Sukses $status previlege";
        return back()->with('success', $message);
    }

    public function updateRole(Request $request)
    {
        $user = User::find($request->user_id);

        $user->assignRole($request->role);
        $status = 'memperbarui';

        $message = "Sukses $status peran menjadi $request->role";
        return back()->with('success', $message);
    }
}
