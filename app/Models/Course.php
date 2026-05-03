<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'section_id',
        'course_name',
        'course_code',
        'day',
        'date',
        'doctor',
        'location'
    ];
    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
