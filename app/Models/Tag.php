<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_tag')->withTimestamps();
    }
}
