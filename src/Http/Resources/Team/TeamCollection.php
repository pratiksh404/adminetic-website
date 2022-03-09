<?php

namespace Adminetic\Website\Http\Resources\Team;

use Adminetic\Website\Http\Resources\Team\TeamResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TeamCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return TeamResource::collection($this->collection);
    }
}
