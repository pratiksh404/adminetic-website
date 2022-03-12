<?php

namespace Adminetic\Website\Traits;

use Adminetic\Website\Models\Admin\Category;

trait HasCategory
{
    public function category()
    {
        return $this->morphOne(Category::class, 'categorizable');
    }

    public function categories()
    {
        return $this->morphMany(Category::class, 'categorizable');
    }

    public function manyCategories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
