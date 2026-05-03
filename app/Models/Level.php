<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Laiha;

class Level extends Model
{
    protected $fillable = [
        'name',
        'laiha_id',
        'time'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function laiha()
    {
        return $this->belongsTo(Laiha::class);
    }
}
