<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Stash;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StashController extends Controller
{

    public function fetch($id)
    {
        $stash = DB::raw("SELECT stashs.id, stashs.user_id, users.name, stashs.beginning_balance, stashs.ending_balance, stashs.stash_date, stashs.stash_amount FROM `stashs`, `users`, `cooperatives` WHERE stashs.user_id = users.id AND users.cooperative_id = cooperatives.id AND stashs.id = " . $id);
        $stash = DB::select($stash);

        return response()->json($stash[0]);
    }

    public function store(Request $request)
    {
        try {

            Stash::create([
                'user_id' => $request->user_id,
                'beginning_balance' => $request->beginning_balance,
                'ending_balance' => $request->ending_balance,
                'stash_amount' => $request->stash_amount,
                'stash_date' => $request->stash_date,
            ]);

            return redirect()->route('dashboard.management.stash')->with('success', 'Stash successfully added!');
        } catch (Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            Stash::where('id', $id)->update([
                'user_id' => $request->user_id,
                'beginning_balance' => $request->beginning_balance,
                'ending_balance' => $request->ending_balance,
                'stash_amount' => $request->stash_amount,
                'stash_date' => $request->stash_date,
            ]);

            return redirect()->route('dashboard.management.stash')->with('success', 'Stash successfully updated!');
        } catch (Exception $th) {
            dd($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Stash::where('id', $id)->delete();

            return redirect()->route('dashboard.management.stash')->with('success', 'Stash successfully deleted!');
        } catch (Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
