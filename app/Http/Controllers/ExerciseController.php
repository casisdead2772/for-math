<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\ExerciseService;
use App\Services\Subject\SubjectService;

class ExerciseController extends Controller
{
    protected ExerciseService $exerciseService;
    protected SubjectService $subjectService;

    /**
     * ReserveController constructor.
     * @param ExerciseService $exerciseService
     *
     */
    public function __construct(ExerciseService $exerciseService, SubjectService $subjectService)
    {
        $this->exerciseService = $exerciseService;
        $this->subjectService = $subjectService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $subjects = $this->subjectService->getSubjects();
        try {
            $exercises = $this->exerciseService->getExerciseList($request);
        } catch (Exception $e) {
            $exercises = [
                'error' => $e->getMessage()
            ];
        }
        return view('exercise.exercise', compact(['exercises', 'subjects']));
    }

    public function show($id)
    {
        try {
            $exercise = $this->exerciseService->getExercise($id);
        } catch (Exception $e) {
            return view('errors.exception', ['error'=>$e->getMessage()]);
        }
        return view('exercise.solve-exercise', ['exercise' => $exercise]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'subject',
            'task',
            'answer'
        ]);

        try {
            $exercise = $this->exerciseService->updateExercise($data, $id);
        } catch (Exception $e) {
            return view('errors.exception', ['error'=>$e->getMessage()]);
        }

        $request->session()->flash('alert-success', 'Exercise was successful updated!');
        return view('exercise.edit-exercise', ['exercise' => $exercise, 'subjects' => $this->subjectService->getSubjects()]);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'subject',
            'task',
            'answer'
        ]);

        try {
            $this->exerciseService->createExercise($data);
        } catch (Exception $e) {
            return view('errors.exception', ['error'=>$e->getMessage()]);
        }

        $request->session()->flash('alert-success', 'Exercise was successful added!');
        return redirect()->route('exercises.create');
    }

    public function destroy($id)
    {
        try {
            $this->exerciseService->deleteExercise($id);
        } catch (Exception $e){
            return view('errors.exception', ['error'=>$e->getMessage()]);
        }

        return redirect()->route('my-exercises');
    }
    //
    public function showUserExercises()
    {
        return view('exercise.my-exercises', ['myExercises' => $this->exerciseService->getUserExercises()]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('exercise.create-exercise', ['subjects' => $this->subjectService->getSubjects()]);
    }

    public function edit($id)
    {
        $exercise = $this->exerciseService->getExercise($id);
        return view('exercise.edit-exercise', ['exercise' => $exercise, 'subjects' => $this->subjectService->getSubjects()]);
    }
}
