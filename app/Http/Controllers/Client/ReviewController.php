<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function submitReview(Request $request, $orderId, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($orderId);
        $statusOrder = $order->statusOrder->first();

        if ($statusOrder && $statusOrder->id !== 4) { // 4 là trạng thái hoàn thành
            return response()->json(['error' => 'Chỉ những đơn hàng đã hoàn thành mới có thể đánh giá.'], 403);
        }

        if (!$order->order_details()->where('product_id', $productId)->exists()) {
            return response()->json(['error' => 'Sản phẩm này không nằm trong đơn hàng.'], 403);
        }

        // Kiểm tra xem đánh giá đã tồn tại cho sản phẩm và đơn hàng này chưa
        $existingReview = Review::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'Bạn đã đánh giá sản phẩm này cho đơn hàng này.'], 403);
        }

        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $productId;
        $review->order_id = $orderId;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return response()->json([
            'message' => 'Đã gửi đánh giá thành công!',
            'review' => $review->load('user')
        ], 200);
    }

}
