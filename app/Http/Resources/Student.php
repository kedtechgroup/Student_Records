<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'email'  => $this->email,
            'gender' => $this->gender,
            'dob'    => $this->dob,
            'status' => $this->status,
            'class'  => $this->whenLoaded('class')
        ];
    }
}
