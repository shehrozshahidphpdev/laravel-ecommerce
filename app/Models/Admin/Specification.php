<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $guarded = [];

    protected $table = 'specifications';

    // public function productSpecifications()
    // {
    //     return $this->hasMany(ProductSpecifications::class);
    // }

    public function label()
    {
        return Attribute::make(
            set: function ($value) {
                $labels = is_array($value) ? $value : json_decode($value, true);
                $capitalizedLabels = array_map(function ($item) {
                    return ucwords($item);
                }, (array)$labels);
                return json_encode(array_values($capitalizedLabels));
            }
        );
    }
}
