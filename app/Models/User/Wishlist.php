<?php

namespace App\Models\User;

use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
