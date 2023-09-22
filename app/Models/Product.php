<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $dates = ['created_at'];
    protected $fillable = [
        'product_code',
        'name',
        'description',
        'quantity',
        'purchase_price',
        'sale_price',
        'image_url',
        'category_id',
        'status',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
