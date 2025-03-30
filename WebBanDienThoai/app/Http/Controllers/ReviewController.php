<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews.
     */
    public function getAll()
    {
        $reviews = Review::where('isDeleted', false)
            ->with(['product', 'user'])
            ->get();
            
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $reviews
        ], 200);
    }

    /**
     * Display reviews for a specific product.
     */
    public function getByProductId($productId)
    {
        // Check if product exists
        $product = Product::where('productId', $productId)
            ->where('isDeleted', false)
            ->first();
            
        if (!$product) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy sản phẩm!'
            ], 404);
        }
        
        $reviews = Review::where('productId', $productId)
            ->where('isDeleted', false)
            ->with('user')
            ->get();
            
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $reviews
        ], 200);
    }

    /**
     * Display reviews by a specific user.
     */
    public function getByUserId($userId)
    {
        $reviews = Review::where('userId', $userId)
            ->where('isDeleted', false)
            ->with('product')
            ->get();
            
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $reviews
        ], 200);
    }

    /**
     * Get a specific review by ID.
     */
    public function getById($previewId)
    {
        $review = Review::where('previewId', $previewId)
            ->where('isDeleted', false)
            ->with(['product', 'user'])
            ->first();
            
        if (!$review) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy đánh giá!'
            ], 404);
        }
        
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $review
        ], 200);
    }

    /**
     * Create a new review.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required|string',
                'productId' => 'required|exists:products,productId',
                'userId' => 'required|exists:users,userId',
            ], [
                'content.required' => 'Vui lòng nhập nội dung đánh giá.',
                'productId.required' => 'Vui lòng chọn sản phẩm cần đánh giá.',
                'productId.exists' => 'Sản phẩm không tồn tại.',
                'userId.required' => 'Vui lòng cung cấp thông tin người dùng.',
                'userId.exists' => 'Người dùng không tồn tại.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        // Check if product is not deleted
        $product = Product::where('productId', $request->productId)
            ->where('isDeleted', false)
            ->first();
            
        if (!$product) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy sản phẩm hoặc sản phẩm đã bị xóa!'
            ], 404);
        }

        $review = Review::create([
            'content' => $request->content,
            'productId' => $request->productId,
            'userId' => $request->userId,
            'isDeleted' => false
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Thêm đánh giá thành công!',
            'data' => $review
        ], 200);
    }

    /**
     * Update a review.
     */
    public function update(Request $request, $previewId)
    {
        $review = Review::where('previewId', $previewId)
            ->where('isDeleted', false)
            ->first();
            
        if (!$review) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy đánh giá!'
            ], 404);
        }

        try {
            $request->validate([
                'content' => 'required|string',
            ], [
                'content.required' => 'Vui lòng nhập nội dung đánh giá.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        $review->update([
            'content' => $request->content
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Cập nhật đánh giá thành công!',
            'data' => $review
        ], 200);
    }

    /**
     * Soft delete a review.
     */
    public function delete($previewId)
    {
        $review = Review::where('previewId', $previewId)
            ->where('isDeleted', false)
            ->first();
            
        if (!$review) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy đánh giá!'
            ], 404);
        }

        $review->update(['isDeleted' => true]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Xóa đánh giá thành công!'
        ], 200);
    }
}