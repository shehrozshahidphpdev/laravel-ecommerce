<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];

    protected $table = 'colors';

    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'color_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color')
            ->withPivot('stock_quantity');
    }
}
