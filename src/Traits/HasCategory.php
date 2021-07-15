<?php

namespace Adminetic\Website\Traits;

use Adminetic\Website\Models\Admin\Category;

trait HasCategory
{
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
