<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\Exceptions\BadRequestException;
use App\Services\ExerciseService;
use App\Services\Result\ResultService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    protected ExerciseService $exerciseService;
    protected ResultService $resultService;

    /**
     * ReserveController constructor.
     * @param ExerciseService $exerciseService
     * @param ResultService $resultService
     */
    public function __construct(ExerciseService $exerciseService, ResultService $resultService)
    {
        $this->exerciseService = $exerciseService;
        $this->resultService = $resultService;
    }

    public function store(Request $request, $id)
    {
        try {
            $result = $this->resultService->checkAnswer($request, $id);
            if($result){
                $request->session()->flash('alert-success', 'Right Answer!');
            } else {
                $request->session()->flash('alert-danger', 'Wrong answer!');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
