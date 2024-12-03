<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\BlockedUser;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function fetchChatRooms()
    {
        $chatRoom = ChatRoom::with(['user.blocked_user'])
        ->latest('last_message_time')
        ->get();

        // $message = Message::query()->where('user_id', $chatRoom->id)->latest("id")->get();
        return response()->json($chatRoom); 
    }

    public function fetchMessages($chatRoomId)
    {
        $messages = Message::query()
            ->where('chat_room_id', $chatRoomId)
            ->get();

        return response()->json($messages);
    }

    public function fetchChatRoomId()
    {
        $chatRoomId = ChatRoom::query()->where('user_id', Auth::id())->first()?->id;

        return response()->json($chatRoomId);
    }

    public function markAsRead($chatRoomId)
    {
        Message::where('chat_room_id', $chatRoomId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // Xử lý chặn user
    public function blockUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        BlockedUser::firstOrCreate([
            'user_id' => $request->user_id,
            'admin_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'User đã bị chặn!']);
    }

    // Xử lý bỏ chặn user
    public function unblockUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        BlockedUser::where('user_id', $request->user_id)
            ->where('admin_id', auth()->id())
            ->delete();

        return response()->json(['message' => 'User đã được bỏ chặn!']);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'content' => 'required|string',
        ]);

        $isBlocked = BlockedUser::where('user_id', Auth::id())->exists();

        if ($isBlocked) {
            return response()->json(['error' => 'Bạn đã bị chặn bởi admin'], 403);
        }

        ChatRoom::where('id', $request->chat_room_id)
            ->update([
                'last_message_time' => now(),
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
