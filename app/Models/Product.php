<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'image', 'serial', 'product_short'];

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
