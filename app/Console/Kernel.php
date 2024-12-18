<?php

namespace App\Console;

use App\Jobs\CompleteOrderJob;
use App\Jobs\CompleteVoucherJob;
use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
        // $schedule->command('check:voucher-status')->everyFiveSeconds();
        $schedule->job(new CompleteVoucherJob())->everyFiveSeconds();
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:update-status')->everyFifteenSeconds();
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
