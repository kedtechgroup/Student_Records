<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassesCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->paginate(50);
    }

    public function with($request)
    {
        return [
            'students' => [
                'count' => 'value',
            ],
        ];
    }
}
