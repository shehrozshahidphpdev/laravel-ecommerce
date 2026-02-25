<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
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
