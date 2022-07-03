<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function fetch($id)
    {
        $transactionDetails = TransactionDetail::with([
            'transaction',
            'transaction.product',
            'user'
        ])->where('id', $id)->first();
        return response()->json($transactionDetails);
    }
}
