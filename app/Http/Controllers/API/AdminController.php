<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

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
            'address' => 'required',
            'gender' => 'required',
            'is_verified' => 'required'
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
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->phone_number = $request->phone_number;
                $user->profile_photo_path = '/profile_picture/' . $file_name;
                $user->is_verified = $request->is_verified;
                $user->save();
            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->phone_number = $request->phone_number;
                $user->is_verified = $request->is_verified;
                $user->save();
            }
            return back()->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            FacadesValidator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'role_id' => 'required|exists:roles,id',
                'phone_number' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'cooperative_id' => 'required|exist:cooperatives,id',
                'password' => 'required',
            ]);

            if($request->hasFile('profile_photo_path')) {
                $request->validate([
                    'profile_photo_path' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);
                $file = $request->file('profile_photo_path');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('profile_picture'), $file_name);
                $request->profile_photo_path = '/profile_picture/' . $file_name;
            } else {
                $request->profile_photo_path = null;
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'profile_photo_path' => $request->profile_photo_path,
                'cooperative_id' => $request->cooperative_id,
                'gender' => $request->gender,
                'is_verified' => 0,
                'password' => bcrypt('12345678'),
            ]);

            return redirect()->route('dashboard.administrator')->with('success', 'User created successfully');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $title = 'Administrator';
        $roles = Role::all();
        $administrators = User::where([
            ['name', 'like', '%' . $request->keyword . '%'],
            ['cooperative_id', $request->cooperative_id],
        ])->get();
        return view('administrator.index', [
            'user' => $user,
            'title' => $title,
            'cooperative_id' => $user->cooperative_id,
            'administrators' => $administrators,
            'roles' => $roles
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
