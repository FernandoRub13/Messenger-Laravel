<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index( Request $request )
    {
        $userId = auth()->user()->id;
        $contactId = $request->contact_id;
        return Message::select(
            'id', 
            DB::raw("IF(`from_id`=$userId,TRUE,FALSE) as written_by_me"), 
            'created_at', 
            'content')
        ->where('from_id', $userId)->where('to_id', $contactId) 
        ->orWhere('from_id', $contactId)->where('to_id', $userId)
        ->get();
    }
    public function store(Request $request)
    {
        $message = new Message();
        $message->from_id = auth()->user()->id;
        $message->to_id = $request->to_id;
        $message->content = $request->content;
        $message->save();

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);

    }
}
