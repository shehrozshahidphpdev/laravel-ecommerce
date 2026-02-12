<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];


    protected $casts = [
        'tags' => 'array'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    /**
     * Category Model
     *
     * This model represents an e-commerce category.
     *
     * Categories use a self-referencing relationship to support
     * parent and child categories (hierarchical structure).
     *
     * Database Structure:
     * - id (primary key)
     * - name
     * - parent_id (nullable, references id in the same table)
     *
     * Relationship Logic:
     * - If parent_id is NULL → This is a main (parent) category.
     * - If parent_id has a value → This category belongs to another category.
     *
     * Example:
     *
     * Electronics (id = 1, parent_id = NULL)
     * ├── Mobiles   (id = 2, parent_id = 1)
     * ├── Laptops   (id = 3, parent_id = 1)
     * └── Featured  (id = 4, parent_id = 1)
     *
     * Relationship Rules:
     * - A child category BELONGS TO one parent.
     * - A parent category HAS MANY child categories.
     *
     * Important:
     * The table that stores the foreign key (parent_id)
     * defines the "belongsTo" relationship.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
