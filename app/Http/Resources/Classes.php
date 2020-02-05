<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Classes extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'teacher_id' => $this->teacher_id,
            'stream_id'  => $this->stream_id,
            'stream'     => $this->stream,
            'teacher'    => $this->teacher,
        ];
    }
}
