<?php

namespace App\Http\Controllers;


use App\Http\Requests\ExerciseStoreRequest;
use App\Services\Result\ResultService;
use App\Services\Tag\TagService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\ExerciseService;
use App\Services\Subject\SubjectService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExerciseController extends Controller
{
    protected ExerciseService $exerciseService;
    protected SubjectService $subjectService;
    protected ResultService $resultService;
    protected TagService $tagService;

    /**
     * ReserveController constructor.
     * @param ExerciseService $exerciseService
     * @param SubjectService $subjectService
     * @param ResultService $resultService
     * @param TagService $tagService
     */
    public function __construct(ExerciseService $exerciseService, SubjectService $subjectService, ResultService $resultService, TagService $tagService)
    {
        $this->exerciseService = $exerciseService;
        $this->subjectService = $subjectService;
        $this->resultService = $resultService;
        $this->tagService = $tagService;
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
            $results = $this->resultService->getUserResult($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.solve-exercise', compact(['exercise', 'results', 'tags']));
    }

    public function update(ExerciseStoreRequest $request, $id)
    {
        try {
            $exercise = $this->exerciseService->updateExercise($request, $id);
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
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function showUserExercises(Request $request)
    {
        try {
            $exercises = $this->exerciseService->getUserExercises($request, Auth::id());
            $subjects = $this->subjectService->getSubjects();
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.my-exercises', compact(['exercises', 'subjects']));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function create(): Factory|View|Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $subjects = $this->subjectService->getSubjects();
            $tags = $this->tagService->getTags();
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view('exercise.create-exercise', compact(['subjects', 'tags']));
    }

    public function edit($id)
    {
        try {
            $subjects = $this->subjectService->getSubjects();
            $exercise = $this->exerciseService->getExercise($id);
            $tags = $this->tagService->getTags();
        } catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.edit-exercise', compact(['subjects', 'exercise', 'tags']));
    }
}
