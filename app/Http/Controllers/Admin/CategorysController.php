<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorysRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategorysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Sử dụng query builder thay vì all() để áp dụng tìm kiếm
        $listcategory = Category::query()
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')   
            ->paginate(10);
    
        return view('admin.category.index', compact('listcategory', 'search'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorysRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            
            if ($request->hasFile('image')) {
                $params['image'] = $request->file('image')->store('uploads/images', 'public') ?: null;
            }
            
            Category::create($params);  
            return redirect()->route('admin.category.index'); 
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $category = Category::findOrFail($id);
            if ($request->hasFile('image')) {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $params['image']  = $request->file('image')->store('uploads/images', 'public');
            } else {
                $params['image'] = $category->image;
            }

            $category->update($params);
            return redirect()->route('admin.category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('admin.category.index');
    }
}
