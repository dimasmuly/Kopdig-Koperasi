<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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

    public function update(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'detail_transaction_id' => 'required',
            'order_date' => 'required',
            'status' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'note' => 'nullable',
            'destination_address' => 'required',
            'payment_method_id' => 'required',
            'total_pay' => 'required',
        ]);

        $transactionDetail = TransactionDetail::find($request->detail_transaction_id);
        $transactionDetail->created_at = $request->order_date;
        $transactionDetail->total_pay = $request->total_pay;
        $transactionDetail->payment_method_id = $request->payment_method_id;
        $transactionDetail->status = $request->status;
        $transactionDetail->save();

        $transaction = Transaction::find($request->transaction_id);
        $transaction->quantity = $request->quantity;
        $transaction->destination_address = $request->destination_address;
        $transaction->note = $request->note;
        $transaction->product_id = $request->product_id;
        $transaction->save();

        // back and send flash message
        return redirect('/dashboard/order')->with('success', 'Order has been updated');
    }

    public function delete($id)
    {
        $transactionDetail = TransactionDetail::find($id);
        $transaction = Transaction::find($transactionDetail->transaction_id);

        $transactionDetail->delete();
        $transaction->delete();

        // back and send flash message
        return redirect('/dashboard/order')->with('success', 'Order has been deleted');
    }
}
