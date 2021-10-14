<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * Get the author of the post.
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    protected $fillable = [
        'title',
        'exercise_id'
    ];
}
