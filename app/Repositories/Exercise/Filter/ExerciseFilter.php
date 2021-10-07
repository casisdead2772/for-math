<?php


namespace App\Repositories\Exercise\Filter;

use Illuminate\Support\Arr;
use App\Repositories\Filter\AbstractFilter;

class ExerciseFilter extends AbstractFilter
{
    protected ?int $subjectId;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->subjectId = Arr::get($data, 'subject_id');
    }

    public function getSubjectId()
    {
        return $this->subjectId;
    }
}
