<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanType;
use Exception;
use Illuminate\Http\Request;

class LoanController extends Controller
{

    public function store(Request $request)
    {

        $amount = $request->amount;
        $installment_period = $request->installment_period;
        $installment_principal = $amount / $request->installment_principal;
        $installment_interest = $amount * $installment_period / 100;

        try {
            Loan::create([
                'user_id' => $request->user_id,
                'loan_date' => $request->installment_date,
                'amount' => $request->amount,
                'installment_principal' => $installment_principal,
                'installment_interest' => $installment_interest,
                'installment_remaining' => 1,
                'installment_period' => $request->installment_period,
                'total_installment' => $request->total_installment,
                'loan_type_id' => $request->loan_type_id
            ]);

            return back()->with('success', 'Loan created successfully');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $loan = Loan::find($id);
            $loan->loan_type_id = $request->loan_type_id;
            $loan->amount = $request->amount;
            $loan->total_installment = $request->total_installment;
            $loan->save();
            return back()->with('success', 'Loan updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function delete($id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return response()->json(['success' => 'Loan deleted successfully']);
    }

    public function getLoanType($id)
    {
        $loan_type = LoanType::find($id);
        return response()->json($loan_type);
    }
}
