<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function store(Request $request)
    {
        try {
            Mail::create([
                'user_id' => $request->user_id,
                'subject' => $request->subject,
                'body' => $request->body,
                'status' => 'unread',
                'is_read' => 0,
            ]);
            return back()->with('success', 'Mail sent successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $mail = Mail::find($id);
            $mail->update([
                'subject' => $request->subject,
                'body' => $request->body,
                'status' => $request->status,
                'is_read' => $request->is_read,
            ]);
            return back()->with('success', 'Mail updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        Mail::find($id)->delete();
        return back()->with('success', 'Mail deleted successfully');
    }
}
