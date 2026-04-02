<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    // Bütün section-ları gətir
    public function index(Request $request)
    {
        $query = PageSection::query();
        
        if ($request->has('page_name')) {
            $query->where('page_name', $request->page_name);
        }

        return response()->json($query->orderBy('order_index')->get());
    }

    // Yeni section əlavə et
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'section_key' => 'required|string|max:255',
            'title_az' => 'nullable|string',
            'title_en' => 'nullable|string',
            'title_ru' => 'nullable|string',
            'subtitle_az' => 'nullable|string',
            'subtitle_en' => 'nullable|string',
            'subtitle_ru' => 'nullable|string',
            'content_az' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_ru' => 'nullable|string',
            'image_url' => 'nullable|string',
            'is_active' => 'boolean',
            'order_index' => 'integer'
        ]);

        $section = PageSection::create($validated);
        return response()->json($section, 201);
    }

    // Section-u yenilə
    public function update(Request $request, $id)
    {
        $section = PageSection::findOrFail($id);

        $validated = $request->validate([
            'page_name' => 'string|max:255',
            'section_key' => 'string|max:255',
            'title_az' => 'nullable|string',
            'title_en' => 'nullable|string',
            'title_ru' => 'nullable|string',
            'subtitle_az' => 'nullable|string',
            'subtitle_en' => 'nullable|string',
            'subtitle_ru' => 'nullable|string',
            'content_az' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_ru' => 'nullable|string',
            'image_url' => 'nullable|string',
            'is_active' => 'boolean',
            'order_index' => 'integer'
        ]);

        $section->update($validated);
        return response()->json($section);
    }

    // Section-u sil
    public function destroy($id)
    {
        $section = PageSection::findOrFail($id);
        $section->delete();
        return response()->json(['message' => 'Silindi']);
    }
}
