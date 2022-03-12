<?php

namespace Adminetic\Website\Http\Resources\Popup;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PopupCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return PopupResource::collection($this->collection);
    }
}
