<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\RevenueLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Gələcəkdə auth olduqda adminin öz shop_id-nə uyğun filter ediləcək.
        // İndilik bütün sistemdəki qızğın statistikaları gətiririk.

        $today = Carbon::today()->toDateString(); // Y-m-d formatında veririk ki SQL DATE() funksiyası düzgün işləsin

        // Bugünkü sifarişlər (anonym/qonaq sifarişlər xaric)
        $todaysOrders = Order::whereDate("created_at", $today)->whereNotNull('user_id')->get();
        
        $totalOrdersToday = $todaysOrders->count();
        $revenueToday = $todaysOrders->where("status", "completed")->sum("total_price");

        $activeProducts = Product::count(); // "is_active" filtri də ola bilər

        // Müştərilərin (role = user/customer) sayı
        $totalCustomers = User::where("role", "customer")->orWhere("role", "user")->orWhereNull("role")->count();

        // Ən çox satılan məhsulu tapırıq
        $topSellingProductInfo = null;
        $topProduct = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first();

        if ($topProduct) {
            $productDetail = Product::find($topProduct->product_id);
            if ($productDetail) {
                $topSellingProductInfo = [
                    'name' => $productDetail->name,
                    'sold' => (int)$topProduct->total_sold
                ];
            }
        }

        // Qəbul edilməyi gözləyən (Pending) və ya Hazırlanan (Preparing) sifarişlər - KDS iş yükünü görmək üçün
        $activeOrdersCount = Order::whereIn('status', ['pending', 'preparing'])->whereNotNull('user_id')->count();

        // Toplam Qazanılmış pul (Sifarişlər silinsə belə revenue_logs-dan oxunur)
        $totalRevenueAllTime = RevenueLog::sum("amount");

        // Bütün zamanlar üçün tamamlanan sifarişlər (silinmişlər də daxil olmaqla)
        $totalCompletedOrdersAllTime = RevenueLog::count();

        // Bütün zamanlar üçün ləğv edilən sifarişlər
        $totalCancelledOrdersAllTime = Order::where("status", "cancelled")->whereNotNull('user_id')->count();

        // Bugün ləğv edilən sifarişlər
        $cancelledOrdersToday = $todaysOrders->where("status", "cancelled")->count();

        // Ən son 5 sifarişi (KDS üçün) dashboardda göstərmək. Qonaq sifarişlərini çıxarırıq (user_id != null)
        $recentOrders = Order::with(["items.product", "user"])
                            ->whereNotNull('user_id')
                            ->orderBy("id", "desc")
                            ->take(6)
                            ->get();

        return response()->json([
            "stats" => [
                "totalOrdersToday" => $totalOrdersToday,
                "revenueToday" => $revenueToday,
                "activeProducts" => $activeProducts,
                "totalCustomers" => $totalCustomers,
                "topSellingProduct" => $topSellingProductInfo,
                "activeOrdersCount" => $activeOrdersCount,
                "totalRevenueAllTime" => $totalRevenueAllTime,
                "totalCompletedOrdersAllTime" => $totalCompletedOrdersAllTime,
                "totalCancelledOrdersAllTime" => $totalCancelledOrdersAllTime,
                "cancelledOrdersToday" => $cancelledOrdersToday
            ],
            "recentOrders" => $recentOrders,
        ]);
    }
}
