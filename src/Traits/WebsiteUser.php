<?php

namespace Adminetic\Website\Traits;

use Adminetic\Website\Models\Admin\Post;

trait WebsiteUser
{
    // Relation
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
