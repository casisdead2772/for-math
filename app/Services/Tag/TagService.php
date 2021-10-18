<?php


namespace App\Services\Tag;

use App\Repositories\Tag\TagRepository;

class TagService
{
    protected TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }
    public function getTags()
    {
        return $this->tagRepository->getAll();
    }
}
