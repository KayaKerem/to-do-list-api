<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
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
            'user_count'=>$this->user_count,
            'todolist_count'=>$this->todolist_count,
            'registered_last_week'=>$this->registered_last_week,
            'registered_last_mounth'=>$this->registered_last_mounth,
        ];
    }
}
