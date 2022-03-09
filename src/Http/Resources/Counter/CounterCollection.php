<?php

namespace Adminetic\Website\Http\Resources\Counter;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Adminetic\Website\Http\Resources\Counter\CounterResource;

class CounterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return CounterResource::collection($this->collection);
    }
}
