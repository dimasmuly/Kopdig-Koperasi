<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Administrator';
        $user = auth()->user();
        return view('administrator.business.detailBusiness', [
            'title' => $title,
            'user' => $user,
        ]);
    }
}
