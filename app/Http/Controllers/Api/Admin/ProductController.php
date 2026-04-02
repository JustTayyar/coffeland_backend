<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "asc")->get();
        return response()->json(["data" => $products]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "name_az" => "nullable|string|max:255",
            "name_en" => "nullable|string|max:255",
            "name_ru" => "nullable|string|max:255",
            "category" => "required|string",
            "sub_category" => "nullable|string",
            "price" => "required|numeric|min:0",
            "description" => "nullable|string",
            "description_az" => "nullable|string",
            "description_en" => "nullable|string",
            "description_ru" => "nullable|string",
            "image_url" => "nullable|string",
        ]);

        $product = Product::create($validated);
        return response()->json(["message" => "Məhsul əlavə edildi", "data" => $product], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            "name" => "required|string|max:255",
            "name_az" => "nullable|string|max:255",
            "name_en" => "nullable|string|max:255",
            "name_ru" => "nullable|string|max:255",
            "category" => "required|string",
            "sub_category" => "nullable|string",
            "price" => "required|numeric|min:0",
            "description" => "nullable|string",
            "description_az" => "nullable|string",
            "description_en" => "nullable|string",
            "description_ru" => "nullable|string",
            "image_url" => "nullable|string",
        ]);

        $product->update($validated);
        return response()->json(["message" => "Məhsul yeniləndi", "data" => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(["message" => "Məhsul silindi"]);
    }
}
