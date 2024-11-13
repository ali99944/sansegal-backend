<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelGirl extends Model
{
    protected $table = 'model_girls';

    protected $fillable = [
        'product_id',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
