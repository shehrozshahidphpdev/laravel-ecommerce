<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopegetProductColorsWithCount(Builder $query, $categoryId)
    {
        return $query->whereHas('products', function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId)
                ->where('is_active', 1);
        })
            ->withCount(['products as product_count' => function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId)
                    ->where('is_active', 1);
            }])
            ->get();
    }
}
