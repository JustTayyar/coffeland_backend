<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        // Gələcəkdə rola görə və ya shop_id-yə görə filterlənəcək
        $customers = User::where("role", "customer")
                         ->orWhere("role", "user")
                         ->orWhereNull("role")
                         ->withCount("revenueLogs as orders_count") // Neçə tamamlanmış qalıcı sifariş verib
                         ->orderBy("id", "desc")
                         ->get();

        return response()->json(["data" => $customers]);
    }

    public function destroy($id)
    {
        try {
            $customer = User::findOrFail($id);
            // Sifarişləri falan var deyə bəlkə əvvəlcə onları yoxlamaq lazımdır, 
            // ya da cascade delete qoyulubsa avtomatik silinəcək
            $customer->delete();
            return response()->json(['message' => 'Customer deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Silinərkən xəta baş verdi', 'error' => $e->getMessage()], 500);
        }
    }
}
