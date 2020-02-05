<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $guarded = [];

    protected $with = [
        'stream',
        'teacher'
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
        return $this->belongsToMany(Student::class, '');
    }

    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
}
