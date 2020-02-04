<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
