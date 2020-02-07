<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $guarded = [];

//    protected $with = ['classes'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class,
            'class_student',
            'student_id',
            'class_id')// model ur joining to
        ->withPivot('year_id')
            ->using(ClassStudent::class)
            ->withTimestamps();
    }
}
