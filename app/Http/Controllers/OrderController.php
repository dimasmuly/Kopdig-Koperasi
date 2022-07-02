<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Order';
        return view('order.index', [
            'user' => $user,
            'title' => $title,
        ]);
    }
}
