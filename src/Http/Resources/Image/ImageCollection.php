<?php

namespace Adminetic\Website\Http\Resources\Image;

use Adminetic\Website\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ImageResource::collection($this->collection);
    }
}
