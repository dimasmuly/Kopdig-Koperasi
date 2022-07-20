<?php

namespace App\Http\Controllers;

use App\Models\Dues;
use App\Models\DuesType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DuesController extends Controller
{
    public function index()
    {

        $dues = DB::raw("SELECT dues.id, dues.user_id, users.name, dues.total_pay, dues.dues_amount, dues.created_at, dues_types.type, dues.dues_type_id FROM `dues`, `dues_types`,`users`, `cooperatives` WHERE dues.user_id = users.id AND dues.dues_type_id = dues_types.id AND users.cooperative_id = cooperatives.id AND users.cooperative_id = " . Auth::user()->cooperative_id);

        $dues = DB::select($dues);
        $dues = json_decode(json_encode($dues), true);

        return view('dues.index', [
            'user' => auth()->user(),
            'title' => 'Dues',
            'dues' => $dues,
            'members' => User::where('cooperative_id', Auth::user()->cooperative_id)->get(),
            'dues_types' => DuesType::all(),
        ]);
    }
}
