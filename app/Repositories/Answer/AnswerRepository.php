<?php


namespace App\Repositories\Answer;

use App\Models\Answer;

class AnswerRepository
{
    protected Answer $answer;

    /**
     * AnswerRepository constructor.
     * @param Answer $answer
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function create($answers, $exerciseId)
    {
        foreach ($answers as $answer){
            Answer::create([
                'title' => $answer,
                'exercise_id' => $exerciseId
            ]);
        }
    }
}
