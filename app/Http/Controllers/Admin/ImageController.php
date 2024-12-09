<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\image\StoreImageRequest;
use App\Http\Requests\image\UpdateImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewImage()
    {
        $products = Product::query()->select('id', 'name')->latest('id')->get();

        return view('admin.images.index', compact('products'));
    }
    public function index()
    {
        $images = ProductImage::with('product')
            // ->where('type', 'main')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('product_images')
                    ->where('type', 'main')
                    ->groupBy('product_id');
            })
            ->latest('id')
            ->paginate(10);

        return response()->json($images);
    }

    public function store(StoreImageRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                if ($request->hasFile('image_main')) {
                    ProductImage::create([
                        'product_id' => $request->product_id,
                        'image_url' => Storage::put('uploads/product_images', $request->file('image_main')),
                        'type' => 'main',
                    ]);
                }

                if ($request->hasFile('image_others')) {
                    $this->storeImageOther($request);
                }
            });

            return response()->json([
                'message' => 'Thêm ảnh thành công!',
                'code' => 201,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $image = ProductImage::with('product')->find($id);

            $products = Product::query()->select('id', 'name')->latest('id')->get();

            $imageOthers = ProductImage::with('product')
                ->where('product_id', $image->product_id)
                ->where('type', 'other')
                ->get();

            $data = [
                'image' => $image,
                'image_others' => $imageOthers,
                'products' => $products,
            ];

            return response()->json([
                'data' => $data,
                'code' => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => $th->getMessage(),
                'code' => 404,
            ], 404);
        }
    }

    public function update(UpdateImageRequest $request, string $id)
    {
        $data = $request->validated();

        $imageId = json_decode($request->input('images_id'), true);

        try {
            if (!$request->image_others && !$request->image_main) {
                return response()->json([
                    'message' => 'Không có gì để cập nhật!',
                    'code' => 200,
                ], 200);
            }

            if (!$imageId && $request->image_others) {
                return response()->json([
                    'message' => 'Bạn không thể chỉnh sửa nếu chưa chọn ảnh phụ!',
                    'code' => 422,
                ], 422);
            }

            $imageMain = ProductImage::find($id);

            if ($request->hasFile('image_main')) {
                $data['image_url'] = Storage::put('uploads/product_images', $request->file('image_main'));
                $imageMain->update($data);
            }

            if ($request->hasFile('image_others') && $imageId) {
                if (count($imageId) !== count($request->image_others) && $imageId) {
                    return response()->json([
                        'message' => 'Để được chỉnh sửa, bạn cần UPLOAD số lượng ảnh bằng với số lượng bạn CHỌN!',
                        'code' => 422,
                    ], 422);
                }

                foreach ($request->image_others ?? [] as $key => $image) {
                    $imageOthers = ProductImage::find($imageId[$key]['id']);

                    $imageOthers->update([
                        'product_id' => $request->product_id,
                        'image_url' => Storage::put('uploads/product_images', $image),
                    ]);
                }
            }

            return response()->json([
                'message' => 'Cập nhật thành công!',
                'code' => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $image = ProductImage::find($id);

            $imageOthers = ProductImage::with('product')
                ->where('product_id', $image->product_id)
                ->where('type', 'other')
                ->get();

            DB::transaction(function () use ($image) {
                $image->delete();
                ProductImage::where('product_id', $image->product_id)->delete();
            });

            if (Storage::exists($image->image_url)) {
                Storage::delete($image->image_url);
            }

            foreach ($imageOthers as $item) {
                if (Storage::exists($item->image_url)) {
                    Storage::delete($item->image_url);
                }
            }


            return response()->json([
                'message' => 'Xóa ảnh thành công!',
                'code' => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }

    public function storeImageOther(Request $request)
    {
        try {
            if (!$request->hasFile('image_others')) {
                return response()->json([
                    'message' => 'Vui lòng upload ảnh phụ lên!',
                    'code' => 422,
                ], 422);
            }

            DB::transaction(function () use ($request) {
                if ($request->hasFile('image_others')) {
                    foreach ($request->image_others as $image) {
                        ProductImage::create([
                            'product_id' => $request->product_id,
                            'image_url' => Storage::put('uploads/product_images', $image),
                            'type' => 'other'
                        ]);
                    }
                }
            });

            return response()->json([
                'message' => 'Thêm ảnh phụ thành công!',
                'code' => 201,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }

    public function deleteImageOther(Request $request)
    {
        try {
            $imageId = json_decode($request->input('images_id'), true);

            if (empty($imageId)) {
                return response()->json([
                    'message' => 'Vui lòng chọn ảnh phụ để xóa!',
                    'code' => 422,
                ], 422);
            }
            foreach ($imageId as $id) {
                $image = ProductImage::find($id['id']);
                $image->delete();

                if (Storage::exists($image->image_url)) {
                    Storage::delete($image->image_url);
                }
            }

            return response()->json([
                'message' => 'Xóa ảnh phụ thành công!',
                'code' => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }
}
