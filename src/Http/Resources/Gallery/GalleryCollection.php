<?php

namespace Adminetic\Website\Http\Resources\Gallery;

use Adminetic\Website\Http\Resources\Gallery\GalleryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GalleryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return GalleryResource::collection($this->collection);
    }
}
