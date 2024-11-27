<?php

namespace App\Events;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function broadcastOn()
    {
        return new Channel('order-noti');
    }

    public function broadcastWith()
    {
        return [
            'slug' => $this->order->slug,
            'created_at' =>  Carbon::parse($this->order->created_at)->format('H:i:s d/m/Y'),
        ];
    }
}
