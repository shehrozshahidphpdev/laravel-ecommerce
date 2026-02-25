<?php

namespace App\Models\Admin;

use Attribute;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $guarded = [];

    protected $table = 'product_tags';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function name(): Attribute
    {
        return new Attribute(
            set: fn($value) => ucwords($value),
        );
    }
    /**
     * Get the user that owns the ProductTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
