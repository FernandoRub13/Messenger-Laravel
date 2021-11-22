<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        return Conversation::where('user_id', auth()->user()->id)
        // ->with('contact')
        ->get([
            'id',
            'contact_id',
            'has_blocked',
            'last_message',
            'last_time',
            'listen_notifications',
        ])
        // ->load('contact') eager loading to get all the contact info, in this case we only need the name
        ;
    }
}
