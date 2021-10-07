<?php


namespace App\Repositories\Subject;

use App\Models\Subject;

class SubjectRepository
{
    public function getAll()
    {
        return Subject::all();
    }

}
