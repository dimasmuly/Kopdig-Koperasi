<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $user = auth()->user();

        // ADMINISTRATOR
        $total_administrator = User::where('cooperative_id', $user->cooperative_id)->where([
            ['role_id', '!=', 1,],
            ['is_verified', '=', 1,]
        ])->count();

        // REVENUE
        $total_pay_out_this_month = TransactionDetail::where('cooperative_id', $user->cooperative_id)->where([
            ['status', '=', 'success',],
            ['created_at', '>=', date('Y-m-01'),],
            ['created_at', '<=', date('Y-m-t'),],
        ])->sum('total_pay');
        $total_pay_out_yesterday = TransactionDetail::where('cooperative_id', $user->cooperative_id)->where([
            ['status', '=', 'success',],
            ['created_at', '>=', date('Y-m-d', strtotime('-1 day')),],
            ['created_at', '<=', date('Y-m-d'),],
        ])->sum('total_pay');
        $total_pay_out_this_month_percentage = 0;
        if ($total_pay_out_yesterday != 0) {
            $total_pay_out_this_month_percentage = ($total_pay_out_this_month / $total_pay_out_yesterday) * 100;
            $total_pay_out_this_month_percentage = number_format($total_pay_out_this_month_percentage, 2);

            if ($total_pay_out_this_month_percentage > 100) {
                $total_pay_out_this_month_percentage = 100;
            }
        }
        // ORDER
        $total_order = TransactionDetail::where('cooperative_id', $user->cooperative_id)->where([
            ['status', '=', 'success',],
        ])->count();
        $total_order_this_month = TransactionDetail::where('cooperative_id', $user->cooperative_id)->where([
            ['status', '=', 'success',],
            ['created_at', '>=', date('Y-m-01'),],
            ['created_at', '<=', date('Y-m-t'),],
        ])->count();
        $total_order_yesterday = TransactionDetail::where('cooperative_id', $user->cooperative_id)->where([
            ['status', '=', 'success',],
            ['created_at', '>=', date('Y-m-d', strtotime('-1 day')),],
            ['created_at', '<=', date('Y-m-d'),],
        ])->count();
        $total_order_this_month_percentage = 0;
        if ($total_order_yesterday != 0) {
            $total_order_this_month_percentage = ($total_order_this_month / $total_order_yesterday) * 100;
            $total_order_this_month_percentage = number_format($total_order_this_month_percentage, 2);
        }

        $dues = DB::raw("SELECT sum(dues.total_pay) as 'total_balance' FROM `dues`,`users`, `cooperatives` WHERE dues.user_id = users.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);

        $dues = DB::select($dues);
        $dues = json_decode(json_encode($dues), true)[0]['total_balance'];

        return view('dashboard.index', [
            'title' => $title,
            'user' => $user,
            'total_administrator' => $total_administrator,
            'total_revenue' => $total_pay_out_this_month,
            'percentage_revenue' => $total_pay_out_this_month_percentage,
            'total_order' => $total_order,
            'percentage_order' => $total_order_this_month_percentage,
            'total_balance' => $dues,
        ]);
    }
}
