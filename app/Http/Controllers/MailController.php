<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function index()
    {

        $mails = DB::raw("SELECT mails.id, mails.user_id, mails.subject, mails.body, mails.is_read, mails.status, mails.created_at, users.name FROM mails, users WHERE mails.user_id = users.id AND users.cooperative_id = " . auth()->user()->cooperative_id . " ORDER BY mails.created_at DESC");
        $mails = DB::select($mails);
        $mails = json_decode(json_encode($mails), true);

        $dues = DB::raw("SELECT sum(dues.total_pay) as 'total_balance' FROM `dues`,`users`, `cooperatives` WHERE dues.user_id = users.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);

        $dues = DB::select($dues);
        $dues = json_decode(json_encode($dues), true)[0]['total_balance'];

        return view('mail.index', [
            'user' => auth()->user(),
            'title' => 'Mails',
            'mails' => $mails,
            'users' => User::where('cooperative_id', auth()->user()->cooperative_id)->get(),
            'total_balance' => $dues,
        ]);
    }
}
