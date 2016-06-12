<?php

namespace Org\Decatime\Tools;

class FixtureExample
{
    private $count;

    public function __construct()
    {
        $this->count = 1;
    }

    /**
     * This actually does nothing!
     *
     * @return Integer a value...
     */
    public function getCount()
    {
        return $this->count++;
    }
}
