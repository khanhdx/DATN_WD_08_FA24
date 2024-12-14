<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\Order\IOrderService;
use App\Services\Order\Status\StatusService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật trạng thái đơn hàng từ bên giao hàng';
    protected $orderService;
    protected $statusService;
    public function __construct(IOrderService $iOrderService, StatusService $statusService)
    {
        $this->orderService = $iOrderService;
        $this->statusService = $statusService;
        parent::__construct();
    }

    public function handle()
    {
        $orders = Order::with(['statusOrderDetails'])->get()->toArray();

        foreach ($orders as $order) {

            $response = Http::withHeaders([
                'Token' => env('TOKEN_GHN'),
                'ShopId' => env('SHOP_ID')
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/detail', [
                'order_code' => $order['order_code'],
            ]);

            if ($response->successful()) {
                $shippingData = $response->json();

                // if ($shippingData['data']['status'] === "delivering") {
                //     $this->orderService->updateStatus(3, $order['id']);
                // }

                // if ($shippingData['data']['status'] === "delivered") {
                //     $this->orderService->updateStatus(4, $order['id']);
                // }

                switch ($shippingData['data']['status']) {
                    case 'picking':
                        // Cập nhật trạng thái sang: picking
                        $this->orderService->updateStatus(2, $order['id']);
                        break;
                    case 'picked':
                        // Cập nhật trạng thái sang: picked
                        $this->orderService->updateStatus(3, $order['id']);
                        break;

                    case 'delivering':
                        // Cập nhật trạng thái sang: shipping
                        $this->orderService->updateStatus(4, $order['id']);
                        break;

                    case 'delivered':
                        // Cập nhật trạng thái sang: success
                        foreach ($order['status_order_details'] as $item) {
                            if ($item['status_order_id'] === 4) {
                                $this->orderService->updateStatus(5, $order['id']);
                            }
                        }
                        break;

                    default:
                        Log::info('Nothing change');
                        break;
                }

                Log::info('Order status updated', ['order_id' => $order['id'], 'new_status' => $shippingData['data']['status']]);
            } else {
                Log::warning('Failed to fetch order status', ['order_id' => $order['id']]);
            }
        }

        $this->info('Order statuses updated successfully.');
    }
}
