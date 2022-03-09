<?php

namespace Adminetic\Website\Http\Resources\Testimonial;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'type' => 'testimonials',
            'id' => (string) $this->id,
            'attributes' => parent::toArray($request),
            'links' => [
                'self' => adminShowRoute('testimonial', $this->id),
            ],
        ];
    }
}
