<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
