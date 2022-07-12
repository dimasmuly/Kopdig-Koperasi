<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TransactionDetail;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $businesses = BusinessDetail::with([
            'cooperative',
            'products',
            'business',
        ])->whereHas('business', function ($query) use ($user) {
            $query->where([
                ['cooperative_id', $user->cooperative_id],
            ]);
        })->get();

        // return $businesses;

        $total_business = BusinessDetail::where('cooperative_id', $user->cooperative_id)->count();
        return view('market.index', [
            'user' => $user,
            'title' => $title,
            'total_earnings' => $total_earnings,
            'total_order' => $total_order,
            'total_business' => $total_business,
            'businesses' => $businesses,
        ]);
    }

    public function products($id, Request $request)
    {
        $user = Auth::user();
        $title = 'Market - Products';

        if ($request->name) {
            $products = Product::with(['productCategory', 'voucher', 'ratingValue'])->where([
                ['name', 'like', '%' . $request->name . '%'],
                ['business_detail_id', $id],
            ])->get();
        } else {
            $products = Product::with(['productCategory', 'voucher', 'ratings'])->where('business_detail_id', $id)->get();
        }

        $products->each(function ($product) {
            $product->ratingValue = $product->ratings()->avg('rating_value') ?? 0;
        });

        return view('market.products', [
            'title' => $title,
            'user' => $user,
            'products' => $products,
            'business_detail_id' => $id,
            'product_categories' => ProductCategory::all(),
            'vouchers' => Voucher::all() ?? [],
        ]);
    }
}
