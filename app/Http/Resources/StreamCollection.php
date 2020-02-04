<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class StreamCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->paginate(50);
    }
}
