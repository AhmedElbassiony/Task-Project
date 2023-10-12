<?php

namespace App\Http\Resources\Datatables;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminProfileResource extends JsonResource
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
            'avatar' => asset('images/employeeavtar.jpeg'),
            'created_at'=>$this->created_at->format('d/m/Y - H:i:s'),

        ];
    }
}
