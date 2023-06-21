<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;



class MessageController extends Controller
{
    //
    public function index()
    {
        $messages = Message::latest()->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function destroy(Message $message)
    {
        $message-> delete();

        return redirect()->back()->with([
            'massage' => 'Pesan berhasil di hapus',
            'alert-type' => 'Danger'
        ]);
    }

}
