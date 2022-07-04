<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Administrator';
        return view('administrator.index', [
            'user' => $user,
            'title' => $title,
        ]);
    }
    public function profile()
    {
        $user = auth()->user();
        $title = 'Administrator';
        return view('administrator.profile.index', [
            'user' => $user,
            'title' => $title,
        ]);
    }
}
