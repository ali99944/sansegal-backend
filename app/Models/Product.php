<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'discount',
        'main_image',
        'features',
        'care_instructions',
        'other_images',
        'related_products',
    ];

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function features() {
        return $this->hasMany(ProductFeature::class);
    }
}
