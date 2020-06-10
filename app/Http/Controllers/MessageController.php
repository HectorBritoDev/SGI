<?php

namespace App\Http\Controllers;

use App\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {
        $data = request()->all();
        $data = Message::validation($data);
        $message = Message::create(
            [
                'message' => $data['message'],
                'incident_id' => $data['incident_id'],
                'user_id' => auth()->user()->id,
            ]);

        return back()->with('notification', 'Mensaje enviado');
    }

}
