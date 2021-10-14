<?php

namespace App\Http\Controllers;


use App\Http\Requests\ExerciseStoreRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\ExerciseService;
use App\Services\Subject\SubjectService;
use Illuminate\Support\Facades\Log;

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
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        try {
            $subjects = $this->subjectService->getSubjects();
            $exercises = $this->exerciseService->getExerciseList($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.exercise', compact(['exercises', 'subjects']));
    }

    public function show($id)
    {
        try {
            $exercise = $this->exerciseService->getExercise($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.solve-exercise', compact(['exercise']));
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
            $request->session()->flash('alert-success', 'Exercise was successful updated!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.edit-exercise', ['exercise' => $exercise, 'subjects' => $this->subjectService->getSubjects()]);
    }

    public function store(ExerciseStoreRequest $request)
    {
        try {
            $this->exerciseService->createExercise($request);
            $request->session()->flash('alert-success', 'Exercise was successful added!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('exercises.create');
    }

    public function destroy($id)
    {
        try {
            $this->exerciseService->deleteExercise($id);
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->action([__CLASS__, 'showUserExercises'])->with('alert-success', 'deleted');
    }
    //
    public function showUserExercises()
    {
        try {
            $myExercises = $this->exerciseService->getUserExercises();
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.my-exercises', ['myExercises' => $myExercises]);
    }

    /**
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function create(): Factory|View|Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $subjects = $this->subjectService->getSubjects();
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view('exercise.create-exercise', ['subjects' => $subjects]);
    }

    public function edit($id)
    {
        try {
            $subjects = $this->subjectService->getSubjects();
            $exercise = $this->exerciseService->getExercise($id);
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view('exercise.edit-exercise', ['exercise' => $exercise, 'subjects' => $subjects]);
    }
}
