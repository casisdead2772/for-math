<?php


namespace App\Repositories\Exercise;

use App\Models\Exercise;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Repositories\Exercise\Filter\ExerciseFilter;


class ExerciseRepository
{
    /**
     * @var Exercise
     */
    protected Exercise $exercise;

    /**
     * @param Exercise $exercise
     */
    public function __construct(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    /**
     * @param $data
     * @return Exercise
     */
    public function save($data)
    {
        $exercise = new $this->exercise;
        $exercise->user_id = $data['user_id'];
        $exercise->subject_id = $data['subject'];
        $exercise->name = $data['name'];
        $exercise->task = $data['task'];
        $exercise->answer = $data['answer'];

        $exercise->save();

        return $exercise->fresh();
    }

    public function update($data, $id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->subject_id = $data['subject'];
        $exercise->name = $data['name'];
        $exercise->task = $data['task'];
        $exercise->answer = $data['answer'];

        $exercise->save();

        return $exercise->fresh();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByUser($id)
    {
        return $this->exercise
            ->where('user_id', $id)
            ->get();

    }

    /**
     * @param ExerciseFilter $exerciseFilter
     */
    public function getAll(ExerciseFilter $exerciseFilter)
    {
        $query = DB::table('exercises')
            ->join('users', 'exercises.user_id', '=', 'users.id')
            ->select('exercises.*', 'users.name as username')
            ->orderBy($exerciseFilter->getSort());
        if($exerciseFilter->getSubjectId()){
            $query->where('subject_id', $exerciseFilter->getSubjectId());
        }

        return $query->paginate($exerciseFilter->getLimit());
    }

    public function deleteById($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();
    }

    public function getById($id)
    {
        return Exercise::findOrFail($id);
    }
}
