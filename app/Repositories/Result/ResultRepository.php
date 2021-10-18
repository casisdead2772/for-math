<?php


namespace App\Repositories\Result;


use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class ResultRepository
{
    public function getByUser($id)
    {
         $result = Result::where('exercise_id', $id)
            ->where('user_id', Auth::id())
            ->first();
         return $result;
    }

    public function create($id)
    {
        $result = new Result;
        $result->user_id = Auth::id();
        $result->exercise_id = $id;
        $result->status = 1;
        $result->save();
    }
}
