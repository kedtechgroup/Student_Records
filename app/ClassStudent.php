<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassStudent extends Pivot
{
    protected $table = 'class_student';

    protected $guarded = [];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

}
