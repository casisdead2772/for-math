<?php


namespace App\Services;

use App\Repositories\Exercise\ExerciseRepository;
use App\Repositories\Exercise\Filter\ExerciseFilter;
use App\Services\Answer\AnswerService;
use App\Services\File\FileService;
use App\Services\Tag\TagService;
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
    protected TagService $tagService;

    /**
     * @param ExerciseRepository $exerciseRepository
     * @param AnswerService $answerService
     * @param FileService $fileService
     *
     */
    public function __construct(ExerciseRepository $exerciseRepository, AnswerService $answerService, FileService $fileService, TagService $tagService)
    {
        $this->exerciseRepository = $exerciseRepository;
        $this->answerService = $answerService;
        $this->fileService = $fileService;
        $this->tagService = $tagService;
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

    public function updateExercise($request, $id)
    {
        try {
            $exercise = $this->exerciseRepository->update($request, $id);
            $this->answerService->createAnswers($request->get('answers'), $id);
            return $exercise;
        } catch (\Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function getUserExercises($request, $id)
    {
        $filter = new ExerciseFilter($request->input());
        return $this->exerciseRepository->getByUser($filter, $id);
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

}
