<?php

namespace App\Jobs;

use App\Models\Voucher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompleteVoucherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $vouchers = Voucher::query()->get();
        foreach ($vouchers as $key => $voucher) {
            $today = date('Y-m-d');
            if ($voucher->date_start < $today) {
                $voucher->update(['status'=>'Chưa diễn ra']);
            }
            else if($voucher->date_start > $today && $voucher->date_end > $today) {
                $voucher->update(['status'=>'Đang diễn ra']);
            }
            else {
                $voucher->update(['status'=>'Đã ngừng']);
            }
        }
    }
}
