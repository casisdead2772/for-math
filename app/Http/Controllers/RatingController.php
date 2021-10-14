<?php

namespace App\Http\Controllers;

use App\Services\Rating\RatingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    protected RatingService $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function store(Request $request)
    {
        try {
            $this->ratingService->createRating($request);
            $request->session()->flash('alert-success', 'Exercise was successful added!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return 'success';
    }

    public function index(int $id)
    {
        try {
            $rating = $this->ratingService->getRating($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
        return $rating;
    }

}
