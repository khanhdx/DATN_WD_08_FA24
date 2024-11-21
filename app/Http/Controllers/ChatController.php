<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function fetchChatRooms()
    {
        return User::with(['rooms'])->where('role', 'Khách hàng')->get();
    }
    
    public function fetchMessages($chatRoomId)
    {
        $messages = Message::query()
            ->where('chat_room_id', $chatRoomId)
            ->get();

        return response()->json($messages);
    }

    public function getChatRooms()
    {
        $chatRooms = ChatRoom::with('customer')
        ->where('user_id', Auth::user()->id)
        ->select('id')
        ->first()?->id;
        
        return response()->json($chatRooms);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'chat_room_id' => $request->chat_room_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
