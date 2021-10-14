<?php


namespace App\Services;

use App\Repositories\Exercise\ExerciseRepository;
use App\Repositories\Exercise\Filter\ExerciseFilter;
use App\Services\Answer\AnswerService;
use ErrorException;
use Illuminate\Http\Request;
use http\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ExerciseService
{

    protected ExerciseRepository $exerciseRepository;
    protected AnswerService $answerService;

    /**
     * @param ExerciseRepository $exerciseRepository
     * @param AnswerService $answerService
     */
    public function __construct(ExerciseRepository $exerciseRepository, AnswerService $answerService)
    {
        $this->exerciseRepository = $exerciseRepository;
        $this->answerService = $answerService;
    }

    /**
     * @param Request $request
     */
    public function createExercise(Request $request): void
    {
        try{
            $exercise = $this->exerciseRepository->save($request);
            $this->answerService->createAnswer($request->get('answers'), $exercise->id);
        } catch (\Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function getUserExercises()
    {
        $id = Auth::id();
        return $this->exerciseRepository->getByUser($id);
    }

    public function getExerciseList($request)
    {
        $filter = new ExerciseFilter($request->input());
        return $this->exerciseRepository->getAll($filter);
    }

    public function deleteExercise($id)
    {
        $this->exerciseRepository->deleteById($id);
    }

    public function getExercise($id)
    {
        return $this->exerciseRepository->getById($id);
    }

    public function updateExercise($data, $id)
    {
        $validator = Validator::make($data,[
            'subject' => 'required',
            'name' => 'required',
            'task' => 'required',
            'answer' => 'required',
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->exerciseRepository->update($data, $id);
    }
}
