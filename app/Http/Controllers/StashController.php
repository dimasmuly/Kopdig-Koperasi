<?php

namespace App\Http\Controllers;

use App\Models\Stash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StashController extends Controller
{
    public function index()
    {

        $stashes = DB::raw("SELECT stashs.id, stashs.user_id,users.name, stashs.beginning_balance, stashs.ending_balance, stashs.stash_date, stashs.stash_amount FROM `stashs`, `users`, `cooperatives` WHERE stashs.user_id = users.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);
        $stashes = DB::select($stashes);
        $stashes = json_decode(json_encode($stashes), true);

        // get current beginning balance in stash from last stash date
        $last_stash = Stash::where('user_id', Auth::user()->id)->orderBy('stash_date', 'desc')->first();
        $current_balance = $last_stash->ending_balance;

        return view('stash.index', [
            'user' => Auth::user(),
            'title' => 'Stash',
            'stashes' => $stashes,
            'current_balance' => $current_balance,
        ]);
    }
}
