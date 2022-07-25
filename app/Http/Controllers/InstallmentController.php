<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstallmentController extends Controller
{
    public function index()
    {

        $installments = Installment::with('loan')->get();
        $dues = DB::raw("SELECT sum(dues.total_pay) as 'total_balance' FROM `dues`,`users`, `cooperatives` WHERE dues.user_id = users.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);

        $dues = DB::select($dues);
        $dues = json_decode(json_encode($dues), true)[0]['total_balance'];
        return view('installment.index', [
            'user' => auth()->user(),
            'title' => 'Installment',
            'installments' => $installments,
            'total_balance' => $dues,
        ]);
    }
}
