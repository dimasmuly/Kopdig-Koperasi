<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function update(Request $request, $id)
    {
        try {
            $installment = Installment::find($id);
            $installment->update([
                'installment_number' => $request->installment_number,
                'installment_type' => $request->installment_type,
                'pay_date' => $request->pay_date,
                'lateness_date' => $request->lateness_date,
                'total_installment' => $request->total_installment,
                'interest' => $request->interest,
                'fine' => $request->fine,
                'total_pay' => $request->total_pay
            ]);
            return back()->with('success', 'Installment updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error updating installment');
        }
    }

    public function delete($id)
    {
        try {
            $installment = Installment::find($id);
            $installment->delete();
            return back()->with('success', 'Installment deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error deleting installment');
        }
    }
}
