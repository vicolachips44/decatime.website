<?php

namespace Org\Decatime\Adapter;

use Org\Decatime\Entity\Content;

class ContentAdapter
{
    private $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function hydrate(array $data)
    {
        $this->content->setTitle($data['title']);
        $this->content->setPosition($data['position']);
    }
}
