<?php


namespace App\Services\Result;


use App\Models\Result;
use App\Repositories\Result\ResultRepository;
use App\Services\ExerciseService;
use Illuminate\Support\Facades\Auth;

class ResultService
{
    protected ResultRepository $resultRepository;
    protected ExerciseService $exerciseService;

    /**
     * ResultService constructor.
     * @param ResultRepository $resultRepository
     * @param ExerciseService $exerciseService
     */
    public function __construct(ResultRepository $resultRepository, ExerciseService $exerciseService)
    {
        $this->resultRepository = $resultRepository;
        $this->exerciseService = $exerciseService;
    }

    public function checkAnswer($request, $id)
    {
        $exercise = $this->exerciseService->getExercise($id);
        $userAnswer = $request->get('answer');
        $rightAnswers = $exercise->answers;
        foreach($rightAnswers as $rightAnswer)
        {
            if($rightAnswer->title === $userAnswer){
                $this->resultRepository->create($exercise->id);
                return true;
            }
        }
        return false;
    }

    public function getUserResult($id)
    {
        return $this->resultRepository->getByUser($id);
    }
}
