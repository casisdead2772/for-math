<?php


namespace App\Repositories\Exercise;

use App\Models\Exercise;
use DateTime;
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
        $tags = $request->get('tags');
        $exercise = new $this->exercise;
        $exercise->user_id = Auth::id();
        $exercise->subject_id = $request->get('subject');
        $exercise->name = $request->get('name');
        $exercise->task = $request->get('task');
        $exercise->difficulty = $request->get('difficulty');
        $exercise->created_timestamp = (new DateTime)->getTimestamp();
        $exercise->save();

        foreach($tags as $tag){
            $exercise->tags()->attach($tag);
        }

        return $exercise;
    }

    public function update($request, $id)
    {
        $tags = $request->get('tags');

        $exercise = Exercise::findOrFail($id);
        $exercise->subject_id = $request->get('subject0');
        $exercise->name = $request->get('name');
        $exercise->task = $request->get('task');

        foreach($tags as $tag){
            $exercise->tags()->attach($tag);
        }

        return $exercise->fresh();


    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByUser(ExerciseFilter $exerciseFilter, $id)
    {
        $query =  $this->exercise->where('user_id', $id);
        if($exerciseFilter->getSubjectId()){
            $query->where('subject_id', $exerciseFilter->getSubjectId());
        }

        if($exerciseFilter->getSort()){
            $query->orderBy($exerciseFilter->getSort(), 'desc');
        }

        $query->get();

        return $query->paginate($exerciseFilter->getLimit());
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
