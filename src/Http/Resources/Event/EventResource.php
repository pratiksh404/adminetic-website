<?php

namespace Adminetic\Website\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;
use Adminetic\Website\Http\Resources\Gallery\GalleryResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'events',
            'id' => (string) $this->id,
            'attributes' => parent::toArray($request),
            'links' => [
                'self' => adminShowRoute('event', $this->id)
            ]
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'relationships' => [
                'gallery' => GalleryResource::collection($this->whenLoaded('gallery')),
            ],
        ];
    }
}
