<?php


namespace App\Repositories\Exercise\Filter;

use Illuminate\Support\Arr;
use App\Repositories\Filter\AbstractFilter;

class ExerciseFilter extends AbstractFilter
{
    protected ?int $subjectId;
    protected ?string $searchQuery;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->subjectId = Arr::get($data, 'subject_id');
        $this->searchQuery = Arr::get($data, 'search_query', '');
    }

    public function getSubjectId()
    {
        return $this->subjectId;
    }

    public function getSearch()
    {
        return $this->searchQuery;
    }
}
