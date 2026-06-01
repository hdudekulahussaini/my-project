<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [

        'category_id',

        'name',

        'slug',

        'thumbnail',

        'gallery',

        'sale_price',

        'original_price',

        'color',

        'weight',

        'description',

    ];
        public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
