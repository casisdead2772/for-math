<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'task',
        'answer',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
