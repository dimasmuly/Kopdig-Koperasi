<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:6'
        ]);

        $response = Http::post('http://localhost:8000/api/login', $credentials);
        $data = $response->json();
        if($data['meta']['code'] == 200) {
            // set session data
            $request->session()->put('data', [
                'token' => $data['data']['token'],
                'user' => $data['data']['user']
            ]);
            $request->session()->save();
            return redirect()->intended('admin');
        } else {
            return back()->with('error', $data['data']);
        }
    }

    public function logout()
    {
        // remove session data
        session()->forget('data');
        session()->save();
        return redirect()->route('login');
    }
}
