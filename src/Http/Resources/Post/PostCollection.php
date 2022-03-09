<?php

namespace Adminetic\Website\Http\Resources\Post;

use Adminetic\Website\Http\Resources\Post\PostResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return PostResource::collection($this->collection);
    }
}
