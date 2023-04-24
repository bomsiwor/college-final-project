<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;

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
}
