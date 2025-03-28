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
    public function getAll()
    {
        //
        $products = Product::where('isDeleted', false)->with(['brand', 'imageProducts'])->get();
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $products
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
        //
        try {
            $request->validate([
                'productName' => 'required|string',
                'productPrice' => 'required|numeric',
                'description' => 'nullable|string',
                'CPU' => 'nullable|string',
                'RAM' => 'nullable|string',
                'storage' => 'nullable|string',
                'display' => 'nullable|string',
                'battery' => 'nullable|string',
                'brandId' => 'required|exists:brands,brandId',
                'productImages' => 'nullable|array',
                'productImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
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
                'productName' => 'required|string',
                'productPrice' => 'required|numeric',
                'description' => 'nullable|string',
                'CPU' => 'nullable|string',
                'RAM' => 'nullable|string',
                'storage' => 'nullable|string',
                'display' => 'nullable|string',
                'battery' => 'nullable|string',
                'brandId' => 'required|exists:brands,brandId',
                'productImages' => 'nullable',
                'productImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 422,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 422);
        }

        $product->update($request->except(['productImages']));

        if ($request->hasFile('productImages')) {

            $oldImages = ImageProduct::where('productId', $product->productId)->get();

            foreach ($oldImages as $oldImage) {
                $oldImagePath = str_replace('/storage/', 'public/', $oldImage->imagePath);
                Storage::delete($oldImagePath);
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
}
