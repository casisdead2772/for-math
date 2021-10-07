<?php


namespace App\Services\Subject;

use App\Repositories\Subject\SubjectRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class SubjectService
{
    protected SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function getSubjects()
    {
        return $this->subjectRepository->getAll();
    }
}
