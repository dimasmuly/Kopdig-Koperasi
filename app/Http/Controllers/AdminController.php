<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{

    public function index()
    {
        // get session data
        $data = session()->get('data');
        $user = $data['user'];
        return view('admin.index', [
            'user' => $user,
            'title' => 'Admin',
            'page' => 'Dashboard',
        ]);
    }

    public function administrator()
    {
        // get session data
        $data = session()->get('data');
        $user = $data['user'];
        $token = $data['token'];
        $administrators = Http::withToken($token)->get('http://127.0.0.1:8000/api/cooperatives')->json()['data']['cooperative_detail']['users'];
        return view('admin.administrators.index', [
            'user' => $user,
            'title' => 'Admin',
            'page' => 'Administrator',
            'administrators' => $administrators,
        ]);
    }

    public function market()
    {
        // get session data
        $data = session()->get('data');
        $user = $data['user'];
        return view('admin.markets.index', [
            'user' => $user,
            'title' => 'Admin',
            'page' => 'Market',
        ]);
    }

    public function stash()
    {
        // get session data
        $data = session()->get('data');
        $user = $data['user'];
        return view('admin.stashes.index', [
            'user' => $user,
            'title' => 'Admin',
            'page' => 'Stash',
        ]);
    }

    public function loan()
    {
        // get session data
        $data = session()->get('data');
        $user = $data['user'];
        return view('admin.loans.index', [
            'user' => $user,
            'title' => 'Admin',
            'page' => 'Loan',
        ]);
    }

    public function profile_cooprative()
    {
        $data = session()->get('data');
        $user = $data['user'];
        return view('admin.cooprative.index', [
            'user' => $user,
            'title' => 'Admin',
            'page' => 'Loan',
        ]);
    }
}
