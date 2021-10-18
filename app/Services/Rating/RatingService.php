<?php


namespace App\Services\Rating;

use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Http\Request;

class RatingService
{

    protected ExerciseService $exerciseService;

    /**
     * @param ExerciseService $exerciseService
     */
    public function __construct(ExerciseService $exerciseService)
    {
        $this->exerciseService = $exerciseService;
    }
    public function createRating(Request $request)
    {
        $exercise = Exercise::findOrFail($request->get('exercise_id'));
        $exercise->rateOnce($request->get('rating'));
        $exercise->average = (int)(($exercise->averageRating) * 10);
        $exercise->save();
    }

    public function getRating(int $id)
    {
        $exercise = Exercise::findOrFail($id);
        return $exercise->averageRating();
    }
}
