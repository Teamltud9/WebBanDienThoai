<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    public function getAllBrand(Request $request)
    {
        $pageSize = $request-> pageSize;
        $page = $request->page ?? 1;
        $query = Brand::where('isDeleted', false);
                    
        if ($pageSize) {
            $brands = $query->paginate($pageSize, ['*'], 'page', $page);
            
        } else {
            $brands = $query->get(); 
        }
        

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'result' => $brands
        ], 200);
    }


    public function createBrand(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'brandName' => 'required|string',
            ],
            [
                'image.required' => 'Vui lòng chọn hình ảnh.',
                'image.image' => 'Tệp tải lên phải là hình ảnh.',
                'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
                'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
                
                'brandName.required' => 'Vui lòng nhập tên thương hiệu.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        $image = $request->file('image');
        $path = $image->store('images/brands', 'public');

        Brand::create([
            'brandName' => $request->brandName,
            'logo' => '/storage/' . $path,
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Thêm thương hiệu thành công!',
        ],200);
    }

    public function updateBrand(Request $request, $brandId)
    {
        $brand = Brand::where('brandId', $brandId)->first();
        if (!$brand) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy thương hiệu!'
            ], 404);
        }

        try {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
                'brandName' => 'string',
            ],
            [
                'image.image' => 'Tệp tải lên phải là hình ảnh.',
                'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
                'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        if ($request->hasFile('image')) {
            $oldImagePath = str_replace('/storage/', '', $brand->logo);
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }

            $image = $request->file('image');
            $path = $image->store('images/brands', 'public');
            $logo = '/storage/' . $path;
        } else {
            $logo = $brand->logo; 
        }


        $brand->update([
            'brandName' => $request->brandName?? $brand->brandName,
            'logo' => $logo,
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Cập nhật thương hiệu thành công!',
        ],200);
    }


    public function deleteBrand($brandId)
    {
        $brand = Brand::where('brandId', $brandId)->first();
        if (!$brand) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy thương hiệu!'
            ], 404);
        }
        

        $brand->update([
            'isDeleted' => true
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Xóa thương hiệu thành công!',
        ],200);
    }
}
