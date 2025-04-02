<?php

namespace App\Http\Controllers;

use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll(Request $request)
    {

        $pageSize = $request-> pageSize;
        $page = $request->page ?? 1;
        $query = Product::where('isDeleted', false)
                    ->with(['brand', 'imageProducts']);
        if ($pageSize) {
            $products = $query->paginate($pageSize, ['*'], 'page', $page);
        } else {
            $products = $query->get(); 
        }
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'result' => $products
        ], 200);
    }

    public function getById($productId)
    {
        //
        $products =  Product::where('productId', $productId)
            ->where('isDeleted', false)
            ->with(['brand', 'imageProducts'])->first();;

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => [$products,]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'productName' => 'required|string',
                'productPrice' => 'required|numeric|min:0',
                'description' => 'required|string',
                'CPU' => 'required|string',
                'RAM' => 'required|integer|min:0',
                'storage' => 'required|string',
                'display' => 'required|string',
                'battery' => 'required|integer|min:0',
                'brandId' => 'required|exists:brands,brandId',
                'productImages' => 'required|array',
                'productImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'productName.required'      => 'Vui lòng nhập tên sản phẩm.',
                'productPrice.required'     => 'Vui lòng nhập giá sản phẩm.',
                'productPrice.min'          => 'Giá sản phẩm không thể nhỏ hơn 0.',
                'description.required'      => 'Vui lòng nhập mô tả sản phẩm.',
                'CPU.required'              => 'Vui lòng nhập thông tin CPU.',
                'RAM.required'              => 'Vui lòng nhập thông tin RAM.',
                'RAM.min'                   => 'Dung lượng RAM không thể nhỏ hơn 0.',
                'storage.required'          => 'Vui lòng nhập thông tin bộ nhớ.',
                'display.required'          => 'Vui lòng nhập thông tin màn hình.',
                'battery.required'          => 'Vui lòng nhập dung lượng pin.',
                'battery.min'               => 'Dung lượng pin không thể nhỏ hơn 0.',
                'brandId.required'          => 'Vui lòng chọn thương hiệu.',
                'brandId.exists'            => 'Thương hiệu không hợp lệ.',
                'productImages.required'    => 'Vui lòng tải lên ít nhất một hình ảnh sản phẩm.',
                'productImages.*.image'     => 'Tệp tải lên phải là hình ảnh.',
                'productImages.*.mimes'     => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
                'productImages.*.max'       => 'Dung lượng hình ảnh không được vượt quá 2MB.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        $product = Product::create(($request->except(['productImages'])));

        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $path = $image->store('images/products', 'public');
                $imagePath = '/storage/' . $path;

                ImageProduct::create([
                    'imagePath' => $imagePath,
                    'productId' => $product->productId
                ]);
            }
        }
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Thêm sản phẩm thành công!'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId)
    {

        $product = Product::where('productId', $productId)->first();
        if (!$product) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy sản phẩm!'
            ], 404);
        }

        try {
            $request->validate([
                'productName' => 'string',
                'productPrice' => 'numeric|min:0',
                'description' => 'string',
                'CPU' => 'string',
                'RAM' => 'integer|min:0',
                'storage' => 'string',
                'display' => 'string',
                'battery' => 'integer|min:0',
                'brandId' => 'exists:brands,brandId',
                'productImages' => 'array',
                'productImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'productPrice.min'          => 'Giá sản phẩm không thể nhỏ hơn 0.',
                'RAM.min'                   => 'Dung lượng RAM không thể nhỏ hơn 0.',
                'battery.min'               => 'Dung lượng pin không thể nhỏ hơn 0.',
                'brandId.exists'            => 'Thương hiệu không hợp lệ.',
                'productImages.*.image'     => 'Tệp tải lên phải là hình ảnh.',
                'productImages.*.mimes'     => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
                'productImages.*.max'       => 'Dung lượng hình ảnh không được vượt quá 2MB.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        $product->update($request->except(['productImages']));

        if ($request->hasFile('productImages')) {

            $oldImages = ImageProduct::where('productId', $product->productId)->get();

            foreach ($oldImages as $oldImage) {
                $oldImagePath = str_replace('/storage/', '', $oldImage->imagePath);
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            ImageProduct::where('productId', $product->productId)->delete();

            foreach ($request->file('productImages') as $image) {
                $path = $image->store('images/products', 'public');
                $imagePath = '/storage/' . $path;

                ImageProduct::create([
                    'imagePath' => $imagePath,
                    'productId' => $product->productId
                ]);
            }
        }

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Cập nhật sản phẩm thành công!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($productId)
    {
        //
        $product = Product::where('productId', $productId)->first();
        if (!$product) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy sản phẩm!'
            ], 404);
        }

        $product->update(['isDeleted' => true]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Xóa sản phẩm thành công!'
        ], 200);
    }
    
    public function filter(Request $request)
    {
        $query = Product::query();

        $filters = ['RAM', 'storage'];
        foreach ($filters as $filter) {
            if ($request->has($filter) && !empty($request->$filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('brandName', $request->brand);
            });
        }

        if ($request->has('minPrice') && is_numeric($request->minPrice)) {
            $query->where('productPrice', '>=', $request->minPrice);
        }

        if ($request->has('maxPrice') && is_numeric($request->maxPrice)) {
            $query->where('productPrice', '<=', $request->maxPrice);
        }

        if ($request->has('query') && !empty($request->query)) {
            $query->where('productName', 'LIKE', '%' . $request->keyword . '%');
        }


        $products = $query->where('isDeleted', false)->with(['brand', 'imageProducts'])->get();
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $products
        ], 200);
    }
    

}
