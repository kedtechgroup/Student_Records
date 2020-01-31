<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
