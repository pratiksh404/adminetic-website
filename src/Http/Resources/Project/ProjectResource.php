<?php

namespace Adminetic\Website\Http\Resources\Project;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type' => 'projects',
            'id' => (string) $this->id,
            'attributes' => parent::toArray($request),
            'links' => [
                'self' => adminShowRoute('project', $this->id),
            ],
        ];
    }
}
