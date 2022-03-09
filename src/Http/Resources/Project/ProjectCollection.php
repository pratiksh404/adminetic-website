<?php

namespace Adminetic\Website\Http\Resources\Project;

use Adminetic\Website\Http\Resources\Project\ProjectResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ProjectResource::collection($this->collection);
    }
}
