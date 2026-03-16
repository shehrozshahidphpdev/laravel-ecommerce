<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'deal_expiration_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color')
            ->withPivot('stock_quantity')
            ->withTimestamps();
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'product_specification')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tag()
    {
        return $this->belongsTo(ProductTag::class);
    }

    protected $table = 'products';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getFullSlugAttribute()
    {
        $slugs = [$this->slug];

        $category = $this->category;

        while ($category) {
            array_unshift($slugs, $category->slug);
            $category = $category->parent;
        }

        return implode('/', $slugs);
    }

    public function scopeSlug(Builder $query, $slug)
    {
        return $query->where('slug', $slug);
    }

    protected function slug()
    {
        return Attribute::make(
            set: fn($value) => strtolower(trim($value)),
        );
    }

    protected function shortDescription()
    {
        return Attribute::make(
            set: fn($value) => strtolower(trim($value)),
        );
    }

    protected function description()
    {
        return Attribute::make(
            set: fn($value) => strtolower(trim($value)),
        );
    }

    protected function sku()
    {
        return Attribute::make(
            set: fn($value) => strtoupper(trim($value)),
        );
    }
}
