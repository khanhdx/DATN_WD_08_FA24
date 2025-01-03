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
        $today = date('Y-m-d');
        foreach ($vouchers as $voucher) {
            // today>>date_start>>date_end
            if ($voucher->date_start > $today) {
                $data = [
                    'status'=>'Chưa diễn ra'
                ];
            }
            // date_start>>todat>>date_end
            else if ($voucher->date_start <= $today && $voucher->date_end >= $today) {
                $data = [
                    'status'=>'Đang diễn ra'
                ];
            }
            // date_start>>date_end>>today
            else {
                $data = [
                    'status'=>'Đã ngừng'
                ];
            }
            $voucher->update($data);
        }
    }
}
