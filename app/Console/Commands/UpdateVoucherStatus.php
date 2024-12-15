<?php

namespace App\Console\Commands;

use App\Models\Voucher;
use Illuminate\Console\Command;

class UpdateVoucherStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-voucher-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
                if($voucher->remaini == 0) {
                    $data = [
                        'status'=>'Hết hàng'
                    ];
                }
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
