<?php

namespace Adminetic\Website\Http\Resources\Facility;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Adminetic\Website\Http\Resources\Facility\FacilityResource;

class FacilityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return FacilityResource::collection($this->collection);
    }
}
