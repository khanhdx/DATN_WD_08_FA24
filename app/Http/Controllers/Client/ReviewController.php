<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function submitReview(Request $request, $orderId, $productId)
    {
        // Xác thực dữ liệu yêu cầu
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Kiểm tra xem đơn hàng có hoàn thành không
        $order = Order::findOrFail($orderId);
        $statusOrder = $order->statusOrder->first(); // Lấy trạng thái đầu tiên
        if ($statusOrder && $statusOrder->name !== 'completed') {
            return response()->json(['error' => 'Chỉ những đơn hàng đã hoàn thành mới có thể đánh giá.'], 403);
        }

         // Kiểm tra xem sản phẩm có trong đơn hàng không
        if (!$order->order_details()->where('product_id', $productId)->exists()) {
            return response()->json(['error' => 'Sản phẩm này không nằm trong đơn hàng.'], 403);
        }
        

        // Tạo đánh giá
        $review = new Review();
        $review->user_id = auth()->id(); // Lưu ID của người dùng đã đăng nhập
        $review->product_id = $productId; // Gán ID sản phẩm
        $review->order_id = $orderId; // Gán ID đơn hàng
        $review->rating = $request->rating; // Gán điểm đánh giá
        $review->review = $request->review; // Gán bình luận
        $review->save(); // Lưu đánh giá vào cơ sở dữ liệu

        return response()->json(['message' => 'Review submitted successfully!'], 200); // Trả về phản hồi thành công
    }
}
