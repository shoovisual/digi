<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'image', 'serial', 'product_short', 'slug', 'product_images', 'product_galleries', 'features', 'specifications'];

    protected $casts = [
        'product_images' => 'array',
        'product_galleries' => 'array',
        'features' => 'array',
        'specifications' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Standard relationship name used across the app
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
