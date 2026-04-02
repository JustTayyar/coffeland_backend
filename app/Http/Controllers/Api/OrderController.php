<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $totalPrice = 0;
            // Assuming for now that all items in an order belong to the same shop
            $shopId = null;

            foreach ($validated['items'] as $item) {
                $totalPrice += ($item['price'] * $item['quantity']);
                if (!$shopId) {
                    $product = \App\Models\Product::find($item['product_id']);
                    $shopId = $product ? $product->shop_id : null;
                }
            }

            $order = Order::create([
                'shop_id' => $shopId,
                'user_id' => $request->input('user_id') ?? $request->user()?->id,
                'total_price' => $totalPrice,
                'status' => 'pending'
            ]);

            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_time' => $item['price']
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Order created successfully!', 'order' => $order->load('items.product')], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order. ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $order = Order::with('items.product')->find($id);
        if (!$order) {
            return response()->json(['error' => 'Sifariş tapılmadı'], 404);
        }
        return response()->json(['order' => $order], 200);
    }

    public function userOrders(Request $request)
    {
        $userId = $request->input('user_id');
        if (!$userId) {
            return response()->json(['error' => 'user_id is required'], 400);    
        }
        $orders = Order::with('items.product')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return response()->json($orders, 200);
    }
}