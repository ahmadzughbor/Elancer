<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'title' => $this->title ,
            'description' => $this->description ,
            'updated_at' => $this->updated_at ,
            'status' => $this->status ,
            'category'=>[
                // 'id' => $this->category->id ,
                // 'name' => $this->category->name ,
            ],
        ];
    }
}
