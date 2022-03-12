<?php

namespace Adminetic\Website\Http\Resources\Counter;

use Illuminate\Http\Resources\Json\ResourceCollection;

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
