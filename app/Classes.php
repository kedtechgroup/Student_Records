<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $guarded = [];

    protected $with = [
        'stream',
        'teacher',
        'students'
    ];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,
            'class_student',
            'class_id',
            'student_id')
            ->withPivot('year_id')
            ->withTimestamps();
    }

    public function studentCount()
    {
        return $this->students()->count();
    }

    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
}
