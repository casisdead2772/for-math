<?php


namespace App\Services;

use App\Repositories\Exercise\ExerciseRepository;
use App\Repositories\Exercise\Filter\ExerciseFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Exception;
use InvalidArgumentException;

class ExerciseService
{
    /**
     * @var $exerciseRepository
     */
    protected ExerciseRepository $exerciseRepository;

    /**
     * @param ExerciseRepository $exerciseRepository
     */
    public function __construct(ExerciseRepository $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
    }

    /**
     * @param array $data
     * @return String
     */
    public function createExercise(array $data): string
    {
        $validator = Validator::make($data,[
            'subject' => 'required',
            'name' => 'required',
            'task' => 'required',
            'answer' => 'required',
        ]);
        $data += ['user_id' => Auth::id()];

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->exerciseRepository->save($data);
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
