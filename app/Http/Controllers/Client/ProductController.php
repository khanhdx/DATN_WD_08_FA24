<?php

namespace App\Http\Controllers\Client;

use App\Models\Color;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ColorController;

class ProductController extends Controller
{
    const PATH_VIEW = 'client.products.';
    public function getProductImage() {
        try {
            $products = Product::doesntHave('image')->select('id', 'name')->get();

            return response()->json([
                'data' => $products,
                'code' => 200,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage(),
                'code' => 404,
            ], 404);
        }
    }
    public function index(Request $request)
{
    // Khởi tạo query
    $query = Product::with(['category']);

    // Lọc theo danh mục nếu có `category_id`
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->input('category_id'));
    }

    // Lọc theo khoảng giá nếu có `prices`
    if ($request->filled('prices')) {
        $prices = $request->input('prices');
        $query->where(function ($q) use ($prices) {
            foreach ($prices as $price) {
                [$min, $max] = explode('-', $price);
                $q->orWhereBetween('price_regular', [(int)$min, (int)$max]);
            }
        });
    }

    // Sắp xếp sản phẩm nếu có `sort`
    if ($request->filled('sort')) {
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price_regular', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_regular', 'desc');
                break;
            default:
                $query->latest('id'); // Mặc định: Sắp xếp theo mới nhất
        }
    } else {
        $query->latest('id'); // Mặc định: Sắp xếp theo mới nhất
    }

    // Phân trang sau khi áp dụng tất cả bộ lọc
    $products = $query->paginate(9);

    // Lấy dữ liệu khác để hiển thị
    $categories = Category::all();
    $colors = Color::all();
    $trendingProducts = Product::with('category')
        ->withCount(['orderDetails as total_sales' => function ($query) {
            $query->select(DB::raw('SUM(quantity)'));
        }])
        ->orderByDesc('total_sales')
        ->take(3)
        ->get();

    // Trả về view với dữ liệu
    return view(self::PATH_VIEW . __FUNCTION__, compact(
        'products',
        'categories',
        'colors',
        'trendingProducts'
    ));
}

    
    public function show(Product $product)
    {
        $product->load(['variants', 'image', 'image_others', 'sizes', 'colors']);
// dd($product->toArray());
        $sumStock = Product::find($product->id)->variants->sum('stock');
        
        $related_products = Product::with(['category'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'product',
            'related_products',
            'sumStock'
        ));
    }

    public function showModal(Product $product)
    {
        try {
            $product->load(['variants', 'image', 'image_others', 'category', 'sizes', 'colors', 'reviews.user']);

            return response()->json($product);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }

    public function getColor(Request $request)
    {
        try {
            $productId = $request->product_id;
            $sizeId = $request->size_id;

            $colors = ProductVariant::query()
                ->where('product_id', $productId)
                ->where('size_id', $sizeId)
                ->get();

            return response()->json($colors);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }
    public function getInStock(Request $request)
    {
        try {
            $productId = $request->product_id;
            $sizeId = $request->size_id;
            $colorId = $request->color_id;

            if ($sizeId && $colorId) {
                $data = ProductVariant::query()
                    ->select(DB::raw("SUM(stock) as stock, REPLACE(FORMAT(price, 0), ',', '.') as price"))
                    ->where('product_id', $productId)
                    ->where('color_id', $colorId)
                    ->where('size_id', $sizeId)
                    ->groupBy('price')
                    ->get();

                return response()->json($data);
            } elseif ($colorId) {
                $data = ProductVariant::query()
                    ->where('product_id', $productId)
                    ->where('color_id', $colorId)
                    ->sum('stock');

                return response()->json($data);
            } else {
                $data = ProductVariant::query()
                    ->where('product_id', $productId)
                    ->where('size_id', $sizeId)
                    ->sum('stock');

                return response()->json($data);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ query string
        $query = $request->input('query');

        // Tìm kiếm sản phẩm theo tên hoặc mô tả
        // $products = Product::where('name', 'LIKE', "%$query%")
        //     ->orWhere('description', 'LIKE', "%$query%")
        //     ->get();
        $products = Product::with(['category'])
            ->where('name', 'LIKE', "%$query%")
            ->orwhere('description', 'LIKE', "%$query%")
            ->latest('id')
            ->paginate(9);

        $categories = Category::all();
        $colors = Color::all();
        $trendingProducts = Product::with('category')
            ->withCount(['orderDetails as total_sales' => function ($query) {
                $query->select(DB::raw('SUM(quantity)'));
            }])
            ->orderByDesc('total_sales')
            ->take(3)
            ->get();

        // Trả về view kèm theo danh sách sản phẩm tìm được
        return view('client.products.SearchPro', compact('products', 'query', 'categories','colors','trendingProducts'));
    }
}
