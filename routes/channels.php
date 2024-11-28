<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{chatRoomId}', function (User $user, int $chatRoomId) {
    $chatRoom = \App\Models\ChatRoom::find($chatRoomId);

    if ($chatRoom && ($user->role === 'Quản lý' || $chatRoom->user_id === $user->id)) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'chat_room_id' => $chatRoomId
        ];
    }
});

Broadcast::channel('order-noti', function () {
    return true;
});
