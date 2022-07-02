<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Market';
        return view('market.index', [
            'user' => $user,
            'title' => $title,
        ]);
    }
}
