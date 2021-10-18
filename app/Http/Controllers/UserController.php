<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ExerciseService;
use App\Services\Subject\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    protected ExerciseService $exerciseService;
    protected SubjectService $subjectService;
    /**
     * UserController constructor.
     * @param ExerciseService $exerciseService
     */
    public function __construct(ExerciseService $exerciseService, SubjectService $subjectService)
    {
        $this->exerciseService = $exerciseService;
        $this->subjectService = $subjectService;
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     */
    public function show(Request $request, $id)
    {
        try {
            $exercises = $this->exerciseService->getUserExercises($request, $id);
            $subjects = $this->subjectService->getSubjects();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('exercise.my-exercises', compact(['exercises', 'subjects']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
