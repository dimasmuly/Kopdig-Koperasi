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
        $administrators = User::where([
            'cooperative_id' => $user->cooperative_id,
        ])->get();
        $roles = Role::all();
        return view('administrator.index', [
            'user' => $user,
            'title' => $title,
            'cooperative_id' => $user->cooperative_id,
            'administrators' => $administrators,
            'roles' => $roles
        ]);
    }
}
