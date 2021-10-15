<?php


namespace App\Repositories\Exercise;

use App\Models\Exercise;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Exercise\Filter\ExerciseFilter;



class ExerciseRepository
{
    protected Exercise $exercise;

    /**
     * @param Exercise $exercise
     */
    public function __construct(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    /**
     * @param $request
     * @return Exercise
     */
    public function save($request)
    {
        $exercise = new $this->exercise;
        $exercise->user_id = Auth::id();
        $exercise->subject_id = $request->get('subject');
        $exercise->name = $request->get('name');
        $exercise->task = $request->get('task');
        $exercise->difficulty = $request->get('difficulty');
        $exercise->save();
        return $exercise;
    }

    public function update($data, $id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->subject_id = $data['subject'];
        $exercise->name = $data['name'];
        $exercise->task = $data['task'];
        $exercise->answer = $data['answer'];

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
        $query = Exercise::search($exerciseFilter->getSearch());
        if($exerciseFilter->getSort()){
            $query->within(env('ALGOLIA_INDEX').'_'.$exerciseFilter->getSort());
        }

        if($exerciseFilter->getSubjectId()){
            $query
                ->where('subject_id', $exerciseFilter->getSubjectId());
        }
        $query->get();

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
