<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->roles()->first()->name ?? null,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'verified'=>(boolean)$this->verified,
            'created_at'=>$this->created_at->format('d/m/Y - H:i:s'),
        ];
    }
}
