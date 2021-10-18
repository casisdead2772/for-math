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
            $response = 'success';
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $response = $e->getMessage();
        }
        return response()->json($response);
    }

    public function index(int $id)
    {
        try {
            $rating = $this->ratingService->getRating($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
        return json_encode($rating, JSON_THROW_ON_ERROR);
    }

}
