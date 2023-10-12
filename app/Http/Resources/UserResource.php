<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->roles()->first()->name ?? null,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'verified'=>(boolean)$this->verified,
        ];
        if ($this->verified){
            $data['token'] = $this->createToken('mobile')->plainTextToken;
        }else
        {
            $data['token'] = null;
        }

        return $data;
    }
}
