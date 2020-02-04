<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->paginate(50);
    }
}
