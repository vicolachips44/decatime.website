<?php

namespace Org\Decatime\Adapter;

use Org\Decatime\Entity\Chapter;

class ChapterAdapter
{
    public function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }

    public function hydrate(array $data)
    {
        $this->chapter->setTitle($data['title']);
        $this->chapter->setPosition($data['position']);
    }
}
