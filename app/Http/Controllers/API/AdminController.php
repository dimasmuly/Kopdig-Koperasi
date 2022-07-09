<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function fetch($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required|exists:roles,id',
            'phone_number' => 'required',
        ]);
        try {
            $user = User::find($request->id);
            if ($request->hasFile('profile_photo_path')) {
                $request->validate([
                    'profile_photo_path' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);
                // delete old photo
                if ($user->profile_photo_path) {
                    $old_photo_path = public_path($user->profile_photo_path);
                    if (file_exists($old_photo_path)) {
                        unlink($old_photo_path);
                    }
                }
                // upload new photo
                $file = $request->file('profile_photo_path');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('profile_picture'), $file_name);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                $user->phone_number = $request->phone_number;
                $user->profile_photo_path = '/profile_picture/' . $file_name;
                $user->save();

            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                $user->phone_number = $request->phone_number;
                $user->save();
            }
            return back()->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
