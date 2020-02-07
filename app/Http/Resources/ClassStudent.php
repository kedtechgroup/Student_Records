<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ClassStudent extends JsonResource
{
    public function toArray($request)
    {
        return [
            'student_id' => $this->student_id,
            'class_id'   => $this->class_id,
            'year_id'    => $this->year_id,
            'student'    => $this->student,
        ];
    }
}
