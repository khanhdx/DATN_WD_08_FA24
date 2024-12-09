<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateImageRequest;
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
    public function viewIndex()
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

    public function store(Request $request)
    {
        try {
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
                'message' => 'Thêm mới ảnh thành công!',
                'code' => 201,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
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
            if (!$imageId || !$request->image_others) {
                return response()->json([
                    'message' => 'Vui lòng chọn ảnh hoặc upload ảnh cần cập nhật!',
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
                        'message' => 'Bạn phải upload số ảnh bằng với số lần bạn chọn!',
                        'code' => 400,
                    ], 400);
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
                'error' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }

    public function deleteImages(Request $request)
    {
        try {
            $imageId = json_decode($request->input('images_id'), true);

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
                'error' => $th->getMessage(),
                'code' => 500,
            ], 500);
        }
    }
}
