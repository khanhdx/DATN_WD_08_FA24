<?php

namespace App\Http\Controllers\Client;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\StatusOrderDetail;
use App\Http\Controllers\Controller;


class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        // Kiểm tra xem đơn hàng đã giao hay chưa (trạng thái 'Giao hàng thành công')
        $order = StatusOrderDetail::where('order_id', $request->order_id)
                    ->where('status_order_id', 4) // ID 4 là "Giao hàng thành công"
                    ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Bạn chưa nhận được hàng, không thể đánh giá sản phẩm.');
        }

        // Kiểm tra xem khách hàng đã đánh giá sản phẩm này chưa
        $existingReview = Review::where('product_id', $productId)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        // Tạo đánh giá mới
        Review::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}
