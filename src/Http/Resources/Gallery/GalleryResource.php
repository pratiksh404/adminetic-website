<?php

namespace Adminetic\Website\Http\Resources\Gallery;

use Adminetic\Website\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'type' => 'galleries',
            'id' => (string) $this->id,
            'attributes' => parent::toArray($request),
            'links' => [
                'self' => adminShowRoute('gallery', $this->id)
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
                'images' => ImageResource::collection($this->whenLoaded('images')),
            ],
        ];
    }
}
