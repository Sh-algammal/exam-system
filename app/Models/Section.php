<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Level;

class Section extends Model
{
    protected $fillable = ['name', 'level_id'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}