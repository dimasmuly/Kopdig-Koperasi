<?php

namespace App\Http\Controllers;

use App\Models\BusinessDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Order';
        // get all product of cooperative
        $products = BusinessDetail::whereHas('business', function ($query) use ($user) {
            $query->where('cooperative_id', $user->cooperative_id);
        })->with('products')->get();
        // merge all product to one array
        $products = $products->flatMap(function ($item) {
            return $item->products;
        });
        // return json_decode($products);
        // get transaction detail and display product name in transaction table
        $transactionDetails = TransactionDetail::with([
            'transaction',
            'transaction.product',
            'user'
        ])->where('cooperative_id', $user->cooperative_id)->paginate(10);

        $payment_method = PaymentMethod::all();
        $dues = DB::raw("SELECT sum(dues.total_pay) as 'total_balance' FROM `dues`,`users`, `cooperatives` WHERE dues.user_id = users.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);

        $dues = DB::select($dues);
        $dues = json_decode(json_encode($dues), true)[0]['total_balance'];
        return view('order.index', [
            'user' => $user,
            'title' => $title,
            'orders' => $transactionDetails,
            'products' => $products,
            'payment_methods' => $payment_method,
            'total_balance' => $dues
        ]);
    }
}
