<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {

        return [
            'id'=>$this->id,
            'is_admin'=>$this->is_admin,
            'name'=>$this->name,
            'todolists'=>$this->todolists
        ];
    }
}
