<?php

namespace Adminetic\Website\Http\Resources\Video;

use Adminetic\Website\Http\Resources\Video\VideoResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return VideoResource::collection($this->collection);
    }
}
