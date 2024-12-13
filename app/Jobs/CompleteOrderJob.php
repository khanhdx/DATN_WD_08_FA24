<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\StatusOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompleteOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $orderId;
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $order = Order::findOrFail($this->orderId);
        if ($order->statusOrder->last()->status_label === "Giao hàng thành công" && now()->diffInDays($order->statusOrder->last()->updated_at) >= 7) {
            $order->statusOrder()->sync([
                StatusOrder::where('name_status', 'success')->first()->id => [
                    'name' => 'success',
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
