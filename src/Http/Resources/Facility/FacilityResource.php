<?php

namespace Adminetic\Website\Http\Resources\Facility;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
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
            'type' => 'facilities',
            'id' => (string) $this->id,
            'attributes' => parent::toArray($request),
            'links' => [
                'self' => adminShowRoute('facility', $this->id),
            ],
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
                'category' => isset($this->category) ? $this->category->toArray() : null,
            ],
        ];
    }
}
