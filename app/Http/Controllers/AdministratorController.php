<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $dues = DB::raw("SELECT sum(dues.total_pay) as 'total_balance' FROM `dues`,`users`, `cooperatives` WHERE dues.user_id = users.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);

        $dues = DB::select($dues);
        $dues = json_decode(json_encode($dues), true)[0]['total_balance'];
        return view('administrator.index', [
            'user' => $user,
            'title' => $title,
            'cooperative_id' => $user->cooperative_id,
            'active_administrators' => $active_administrators,
            'inactive_administrators' => $inactive_administrators,
            'roles' => $roles,
            'total_balance' => $dues,
        ]);
    }
}
