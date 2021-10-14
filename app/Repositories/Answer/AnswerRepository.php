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
        foreach ($answers as $answerTitle){
            if($answerTitle){
                Answer::create([
                    'title' => $answerTitle,
                    'exercise_id' => $exerciseId
                ]);
            }
        }
    }
}
