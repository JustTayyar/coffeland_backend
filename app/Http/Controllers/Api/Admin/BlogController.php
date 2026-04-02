<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(["data" => Blog::orderBy("id", "desc")->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title_az" => "required|string|max:255",
            "title_en" => "nullable|string|max:255",
            "title_ru" => "nullable|string|max:255",
            "content_az" => "required|string",
            "content_en" => "nullable|string",
            "content_ru" => "nullable|string",
            "category_az" => "required|string",
            "category_en" => "nullable|string",
            "category_ru" => "nullable|string",
            "image_name" => "nullable|string",
            "date" => "nullable|date"
        ]);

        $blog = Blog::create($validated);
        return response()->json(["message" => "Bloq əlavə edildi", "data" => $blog], 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            "title_az" => "required|string|max:255",
            "title_en" => "nullable|string|max:255",
            "title_ru" => "nullable|string|max:255",
            "content_az" => "required|string",
            "content_en" => "nullable|string",
            "content_ru" => "nullable|string",
            "category_az" => "required|string",
            "category_en" => "nullable|string",
            "category_ru" => "nullable|string",
            "image_name" => "nullable|string",
            "date" => "nullable|date"
        ]);

        $blog->update($validated);
        return response()->json(["message" => "Bloq yeniləndi", "data" => $blog]);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(["message" => "Bloq silindi"]);
    }
}
