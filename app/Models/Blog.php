<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        "title_az", "title_en", "title_ru",
        "content_az", "content_en", "content_ru",
        "category_az", "category_en", "category_ru",
        "image_name", "date"
    ];
}
