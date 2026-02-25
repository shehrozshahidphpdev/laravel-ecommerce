<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];

    protected $table = 'product_colors';

    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'color_id');
    }
}
