<?php


namespace App\Services\Rating;

use App\Models\Exercise;
use Illuminate\Http\Request;

class RatingService
{
    public function createRating(Request $request)
    {
        $exercise = Exercise::findOrFail($request->get('exercise_id'));
        $exercise->rateOnce($request->get('rating'));
    }

    public function getRating(int $id)
    {
        $exercise = Exercise::findOrFail($id);
        return $exercise->averageRating();
    }
}
