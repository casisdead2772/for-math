<?php


namespace App\Services;

use App\Repositories\Exercise\ExerciseRepository;
use App\Repositories\Exercise\Filter\ExerciseFilter;
use App\Services\Answer\AnswerService;
use App\Services\File\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ExerciseService
{

    protected ExerciseRepository $exerciseRepository;
    protected AnswerService $answerService;
    protected FileService $fileService;

    /**
     * @param ExerciseRepository $exerciseRepository
     * @param AnswerService $answerService
     * @param FileService $fileService
     */
    public function __construct(ExerciseRepository $exerciseRepository, AnswerService $answerService, FileService $fileService)
    {
        $this->exerciseRepository = $exerciseRepository;
        $this->answerService = $answerService;
        $this->fileService = $fileService;
    }

    /**
     * @param Request $request
     */
    public function createExercise(Request $request): void
    {
        try {
            $images = $request->file('files');
            $exercise = $this->exerciseRepository->save($request);
            $this->fileService->uploadExerciseImage($images, $exercise->id);
            $this->answerService->createAnswers($request->get('answers'), $exercise->id);
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
