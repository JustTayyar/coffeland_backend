<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\RevenueLog;

class OrderController extends Controller
{
    /**
     * Get orders for the admin/barista's shop
     */
    public function index(Request $request)
    {
        // Gələcəkdə bura auth()->user()->shop_id ilə yoxlama qoyacağıq. 
        // İndilik sadəcə test üçün 1-ci dükana (shop_id = 1) aid və ya bütün sifarişləri gətiririk.
        $shopId = $request->query('shop_id');

        $query = Order::with('items.product')->orderBy('created_at', 'desc');

        // Əgər shopId verilibsə və null deyilsə filterləsin, əks halda mock məqsədli hamısını gətirsin
        if ($shopId && $shopId !== 'null') {
            $query->where('shop_id', $shopId);
        }

        $orders = $query->get();

        return response()->json($orders);
    }

    /**
     * Update the status of an order
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed,cancelled'
        ]);

        $order->status = $validated['status'];
        $order->save();
        
        // Revenue Log məntiqi
        if ($validated['status'] === 'completed') {
            // Əgər artıq yoxdursa əlavə et
            RevenueLog::firstOrCreate(
                ['order_id' => $order->id],
                ['amount' => $order->total_price, 'user_id' => $order->user_id]
            );
        } else {
            // Tamamlanmışdan başqa statusa (məs: cancelled) keçibsə qazancı sil
            RevenueLog::where('order_id', $order->id)->delete();
        }

        return response()->json([
            'message' => 'Sifarişin statusu yeniləndi!',
            'order' => $order
        ]);
    }

    /**
     * Delete an order
     */
    public function destroy(Order $order)
    {
        $order->items()->delete(); // Əgər cascade delete yoxdursa birinci item-ləri silirik
        $order->delete();
        
        // Qeyd: RevenueLog silinmir! Qazanc persistent olaraq qalır.

        return response()->json([
            'message' => 'Sifariş silindi!'
        ]);
    }
}
