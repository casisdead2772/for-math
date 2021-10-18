<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use willvincent\Rateable\Rateable;

class Exercise extends Model
{
    use Rateable;
    use Searchable;
    use HasFactory;


    /**
     *
     * @return string
     */
    public function searchableAs()
    {
        return env('ALGOLIA_INDEX');
    }

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
        ''
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'exercise_tag')->withTimestamps();
    }

}
