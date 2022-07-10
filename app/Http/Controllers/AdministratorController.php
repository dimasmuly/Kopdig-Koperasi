<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Administrator';
        $active_administrators = User::where([
            'cooperative_id' => $user->cooperative_id,
            'is_verified' => 1,
        ])->get();
        $inactive_administrators = User::where([
            'cooperative_id' => $user->cooperative_id,
            'is_verified' => 0,
        ])->get();
        $roles = Role::all();
        return view('administrator.index', [
            'user' => $user,
            'title' => $title,
            'cooperative_id' => $user->cooperative_id,
            'active_administrators' => $active_administrators,
            'inactive_administrators' => $inactive_administrators,
            'roles' => $roles
        ]);
    }
}
