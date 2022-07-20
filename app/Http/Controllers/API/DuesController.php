<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dues;
use App\Models\DuesType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DuesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $dues = new Dues();
            $dues->user_id = $request->user_id;
            $dues->dues_type_id = $request->dues_type_id;
            $dues->total_pay = $request->total_pay;
            $dues->dues_amount = $request->dues_amount;
            $dues->save();
            return back()->with('success', 'Dues has been added!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function getDuesType($id)
    {
        return json_encode(DuesType::find($id));
    }

    public function update($id, Request $request)
    {
        try {
            $dues = Dues::find($id);
            $dues->dues_type_id = $request->dues_type_id;
            $dues->total_pay = $request->total_pay;
            $dues->dues_amount = $request->dues_amount;
            $dues->created_at = $request->created_at;
            $dues->save();
            return back()->with('success', 'Dues has been updated!');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        Dues::find($id)->delete();
        return back()->with('success', 'Dues has been deleted!');
    }
}
