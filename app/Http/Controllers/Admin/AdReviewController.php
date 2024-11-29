<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AdReviewController extends Controller
{
    public function index(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'start_date' => 'nullable|date|before_or_equal:end_date', // Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc
            'end_date' => 'nullable|date|after_or_equal:start_date',  // Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu
            'rating' => 'nullable|integer|min:1|max:5',               // Số sao phải là số nguyên từ 1 đến 5
        ], [
            'start_date.before_or_equal' => 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'rating.integer' => 'Số sao phải là một số nguyên.',
            'rating.min' => 'Số sao không được nhỏ hơn 1.', 
            'rating.max' => 'Số sao không được lớn hơn 5.',
        ]);

        // Tạo query
        $query = Review::with(['user', 'product'])->orderBy('created_at', 'desc');

        // Lọc theo ngày
        // if ($request->start_date && $request->end_date) {
        //     $query->whereBetween('created_at', [
        //         $request->start_date . ' 00:00:00',
        //         $request->end_date . ' 23:59:59',
        //     ]);
        // }
        if ($request->has('start_date') && $request->has('end_date') && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59',
            ]);
        }

        // Lọc theo số sao
        // if ($request->rating) {
        //     $query->where('rating', $request->rating);
        // }
        if ($request->has('rating') && $request->rating != '') {
            $query->where('rating', $request->rating);
        }

        // Phân trang kết quả
        $reviews = $query->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    // Xóa đánh giá
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Đánh giá đã được xóa.');
    }
}