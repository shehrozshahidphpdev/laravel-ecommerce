<?php

namespace App\Models\Admin;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    protected $guarded = [];

    protected $table = 'brands';

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => ucwords($value)
        );
    }
}
