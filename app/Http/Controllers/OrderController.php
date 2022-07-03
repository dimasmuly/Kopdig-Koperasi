<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Order';
        // get all product of cooperative
        $products = Product::whereHas('businessDetail', function ($query) use ($user) {
            $query->where('cooperative_id', $user->cooperative_id);
        })->get();
        return json_decode($products);
        // get transaction detail and display product name in transaction table
        $transactionDetails = TransactionDetail::with([
            'transaction',
            'transaction.product',
            'user'
        ])->where('cooperative_id', $user->cooperative_id)->paginate(10);
        return view('order.index', [
            'user' => $user,
            'title' => $title,
            'orders' => $transactionDetails
        ]);
    }
}
