<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {

        $loans = DB::raw("SELECT
                            loans.id,
                            loans.user_id,
                            users.name,
                            loans.loan_date,
                            loans.amount,
                            loans.installment_principal,
                            loans.installment_interest,
                            loans.total_installment,
                            loans.installment_remaining,
                            loans.loan_type_id,
                            loan_types.type,
                            loans.installment_period
                        FROM
                            `loans`,
                            `users`,
                            `cooperatives`,
                            `loan_types`
                        WHERE
                            loans.user_id = users.id
                            AND loan_types.id = loans.loan_type_id
                            AND users.cooperative_id = cooperatives.id
                            AND users.cooperative_id = " . Auth::user()->cooperative_id . "
                        ORDER BY
                            loans.loan_date DESC
       ");

        $loan_types = LoanType::all();

        $loans = DB::select($loans);
        $loans = json_decode(json_encode($loans), true);

        return view('loan.index', [
            'user' => auth()->user(),
            'title' => 'Loans',
            'loans' => $loans,
            'loan_types' => $loan_types
        ]);
    }
}
