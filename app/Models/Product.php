<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'shop_id',
        'name', 'name_az', 'name_en', 'name_ru',
        'category',
        'sub_category',
        'price',
        'description', 'description_az', 'description_en', 'description_ru',
        'image_url',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'product_ingredients')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
