<?php


namespace App\Services\Answer;

use App\Repositories\Answer\AnswerRepository;


class AnswerService
{
    protected AnswerRepository $answerRepository;

    /**
     * @param AnswerRepository $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function createAnswer($answers, $exerciseId)
    {
        $this->answerRepository->create($answers, $exerciseId);
    }
}
