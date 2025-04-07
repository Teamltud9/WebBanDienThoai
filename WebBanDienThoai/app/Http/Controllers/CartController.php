<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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


        $cart = Redis::get($cartKey);
        $cart = $cart ? json_decode($cart, true) : [];
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1; 
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => 1,
            ];
        }
        Redis::set($cartKey, json_encode($cart));
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => $cart,
        ], 200);
    }

    public function getCart()
    {
        $userId = Auth::guard('api')->user()->userId;
        $cartKey = 'cart_' . $userId;
        $cart = Redis::get($cartKey);
        $cart = $cart ? json_decode($cart, true) : [];
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
        $cart = Redis::get($cartKey);
        $cart = $cart ? json_decode($cart, true) : [];
        if (!isset($cart[$productId])) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
            ], 404);
        }

        $quantity = $request->quantity;
        $cart[$productId]['quantity'] = (int) $quantity;
        Redis::set($cartKey, json_encode($cart));

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
        $cart = Redis::get($cartKey);
        $cart = $cart ? json_decode($cart, true) : [];

        if (!isset($cart[$productId])) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
            ], 404);
        }

        unset($cart[$productId]);
        Redis::set($cartKey, json_encode($cart));

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

        Redis::del($cartKey);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Đã xóa toàn bộ giỏ hàng',
        ], 200);
    }

    public function checkout()
    {
        $userId = Auth::guard('api')->user()->userId;
        $cartKey = 'cart_' . $userId;

        $cart = Redis::get($cartKey);
        $cart = $cart ? json_decode($cart, true) : [];
        if (empty($cart)) {
            return response()->json([
                'code' => 400,
                'time' => now()->toISOString(),
                'message' => 'Giỏ hàng của bạn đang trống',
            ], 400);
        }

        $order = Order::create([
            'userId' => $userId,
            'totalPrice' => $this->calculateTotalAmount($cart),
        ]);

        
        foreach ($cart as $productId => $item) {
            $order->products()->attach($productId, [
                'quantity' => $item['quantity'],
                'price' => $item['quantity'] * $item['product']['productPrice'],
            ]);
        }

        Redis::del($cartKey);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Thanh toán thành công',
        ], 200);
    }


    private function calculateTotalAmount($cart)
    {
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['quantity'] * $item['product']['productPrice'];
        }
        return $totalAmount;
    }

    public function orderHistory()
    {
        $userId = Auth::guard('api')->user()->userId;

        $orders = Order::with(['products'])->where('userId', $userId)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'orders' => $orders,
        ], 200);
    }


}
