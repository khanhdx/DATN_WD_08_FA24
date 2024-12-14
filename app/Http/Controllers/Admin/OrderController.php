<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\CompleteOrderJob;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\StatusOrderDetail;
use App\Models\Voucher;
use App\Models\vouchersWare;
use App\Models\waresList;
use App\Services\Inventory\InventoryService;
use App\Services\Order\IOrderService;
use App\Services\Order\Status\StatusService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $orderService;
    protected $statusService;
    protected $inventoryService;

    public function __construct(IOrderService $iOrderService, StatusService $statusService, InventoryService $inventoryService)
    {
        $this->orderService = $iOrderService;
        $this->statusService = $statusService;
        $this->inventoryService = $inventoryService;
    }

    public function index(Request $request)
    {
        // Lấy tham số lọc từ request
        $status = $request->input('status');
        $date = $request->input('date');
        $phone = $request->input('phone');

        // Kiểm tra các điều kiện lọc
        if ($status == null && $date == null && $phone == null) {
            $data = $this->orderService->getAll();
        } else {
            $data = $this->orderService->filter($status, $date, $phone);
        }

        $orders = $data[0];
        $countOrderByStatus = $data[1];
        $totalOrder = $data[2];
        $statuses = $this->statusService->getAll();

        return view('admin.orders.index', compact('orders', 'statuses', 'countOrderByStatus', 'totalOrder'));
    }

    public function show(string $id)
    {
        $order = Order::with([
            'user',
            'order_details',
            'order_details.product',
            'order_details.variant.color',
            'order_details.variant.size',
            'statusOrder',
            'payments'
        ])->findOrFail($id);
        $order_details = $order->order_details;
        $currentStatus = $order->statusOrder->last();
        return view('admin.orders.show', compact('order', 'order_details', 'currentStatus'));
    }


    public function updateStatus(Request $request, $id)
    {
        $order = $this->orderService->getOneById($id);
        $currentStatusId = $request->status_order;
        $newStatusId = $currentStatusId + 1;

        if ($newStatusId < $currentStatusId) {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái ngược lại.');
        }

        try {
            DB::transaction(function () use ($order, $newStatusId) {
                $this->orderService->updateStatus($newStatusId, $order->id);
            
                if ($newStatusId == 9) { // Status Canceled 
                    foreach ($order->orderDetails as $detail) {
                        $productVariantId = $detail->product_variant_id;
                        $productId = $detail->product_id;
                        ProductVariant::where('id', $productVariantId)->increment('stock', $detail->quantity);
                        Product::where('id', $productId)->increment('base_stock', $detail->quantity);

                    }
                    $response = Http::withHeaders([
                        'Token' => env('TOKEN_GHN'),
                        'ShopId' => env('SHOP_ID')
                    ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/switch-status/cancel', [
                        'order_codes' => [
                            $order->order_code
                        ],
                    ]);

                    if (!$response->successful()) {
                        Log::error('Cancel Order Fail: ' . $response->body());
                        return redirect()->back()->with('error', 'Có lỗi trong quá trình hủy đơn, quá khách vui lòng thử lại sau!');
                    }

                    // Hủy dùng voucher
                    if ($order->voucher_id && $order->user_id) {
                        $voucher_wave = vouchersWare::query()->where('user_id', '=', $order->user_id)->first(); //Mã kho
                        $wavein = waresList::query()->where('vouchers_ware_id', '=', $voucher_wave->id)->where('voucher_id', '=', $order->voucher_id)->first();
                        $voucher = Voucher::query()->where('id', '=', $order->voucher_id)->first(); //Voucher trên hệ thống
                        // Cập nhật trạng thái
                        $wavein->status = "Chưa sử dụng";
                        $wavein->save();
                        // Cập nhật số lượng
                        $voucher->remaini = $voucher->remaini + 1;
                        $voucher->save();
                    }
                }

                if ($newStatusId == 11) { // Refunded
                    foreach ($order->orderDetails as $detail) {
                        $productVariantId = $detail->product_variant_id;
                        $productId = $detail->product_id;
                        ProductVariant::where('id', $productVariantId)->increment('stock', $detail->quantity);
                        Product::where('id', $productId)->increment('base_stock', $detail->quantity);

                    }
                    $response = Http::withHeaders([
                        'Token' => env('TOKEN_GHN'),
                        'ShopId' => env('SHOP_ID')
                    ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/switch-status/return', [
                        'order_codes' => [
                            $order->order_code
                        ],
                    ]);

                    if (!$response->successful()) {
                        Log::error('Cancel Order Fail: ' . $response->body());
                        return redirect()->back()->with('error', 'Có lỗi trong quá trình hủy đơn, quá khách vui lòng thử lại sau!');
                    }
                }

                if ($newStatusId == 4) { // Status Success
                    CompleteOrderJob::dispatch($order->id)->delay(now()->addDays(7));
                }
            }, 3);
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
