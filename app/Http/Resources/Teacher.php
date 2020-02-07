<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Teacher extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'telephone'  => $this->telephone,
            'id_no'      => $this->id_no,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
