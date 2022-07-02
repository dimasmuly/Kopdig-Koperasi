<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Market';
        $total_earnings = TransactionDetail::where([
            ['cooperative_id', $user->cooperative_id],
            ['status', 'success'],
        ])->sum('total_pay');
        $total_order = TransactionDetail::where([
            ['cooperative_id', $user->cooperative_id],
            ['status', 'success'],
        ])->count();
        $total_customer = TransactionDetail::where([
            ['cooperative_id', $user->cooperative_id],
            ['status', 'success'],
        ])->count('user_id');
        return view('market.index', [
            'user' => $user,
            'title' => $title,
            'total_earnings' => $total_earnings,
            'total_order' => $total_order,
            'total_customer' => $total_customer
        ]);
    }
}
