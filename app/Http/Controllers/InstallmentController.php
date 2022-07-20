<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {

        $installments = Installment::with('loan')->get();
        return view('installment.index', [
            'user' => auth()->user(),
            'title' => 'Installment',
            'installments' => $installments,
        ]);
    }
}
