<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => ($this->getMedia('image')->first() != null) ? $this->getMedia('image')->first()->getUrl() : '',
            'created_at' => 'fjhgffhujf',
        ];
    }
}
