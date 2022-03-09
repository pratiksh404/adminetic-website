<?php

namespace Adminetic\Website\Http\Resources\Event;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Adminetic\Website\Http\Resources\Event\EventResource;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return EventResource::collection($this->collection);
    }
}
