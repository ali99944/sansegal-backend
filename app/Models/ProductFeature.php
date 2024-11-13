<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $table = 'product_features';

    protected $fillable = [
        'name_ar',
        'name_en',  
        'product_id'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
