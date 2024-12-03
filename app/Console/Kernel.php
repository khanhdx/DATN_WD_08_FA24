<?php

namespace App\Console;

use App\Jobs\CompleteOrderJob;
use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $orders = Order::query()->get();
        foreach ($orders as $order) {
            $schedule->job(new CompleteOrderJob($order->id))->daily(); // Chạy sự kiện mỗi ngày
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
