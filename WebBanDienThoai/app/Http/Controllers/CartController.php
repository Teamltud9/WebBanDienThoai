<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($productId)
    {
        $product = Product::find($productId);
        $userId = Auth::guard('api')->user()->userId;
        if (!$product) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        $cartKey = 'cart_' . $userId; 

        $cart = Session::get($cartKey, []); 


        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1; 
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => 1,
            ];
        }
        Session::put($cartKey, $cart);
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
        ], 200);
    }

    public function getCart()
    {
        $userId = Auth::guard('api')->user()->userId;
        $cartKey = 'cart_' . $userId;
        $cart = Session::get($cartKey, []);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => $cart,
        ], 200);
    }

    public function updateCart(Request $request, $productId)
    {
        $userId = Auth::guard('api')->user()->userId;
        $cartKey = 'cart_' . $userId;
        $cart = Session::get($cartKey, []);
        if (!isset($cart[$productId])) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
            ], 404);
        }

        $quantity = $request->quantity;
        $cart[$productId]['quantity'] = (int) $quantity;
        Session::put($cartKey, $cart);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Cập nhật giỏ hàng thành công',
            'cart' => $cart,
        ], 200);
    }


    public function removeFromCart($productId)
    {
        $userId = Auth::guard('api')->user()->userId;
        $cartKey = 'cart_' . $userId;
        $cart = Session::get($cartKey, []);

        if (!isset($cart[$productId])) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
            ], 404);
        }

        unset($cart[$productId]);
        Session::put($cartKey, $cart);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Xóa sản phẩm thành công',
            'cart' => $cart,
        ], 200);
    }

    public function clearCart()
    {
        $userId = Auth::guard('api')->user()->userId;
        $cartKey = 'cart_' . $userId;

        Session::forget($cartKey); 

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Đã xóa toàn bộ giỏ hàng',
        ], 200);
    }
}
