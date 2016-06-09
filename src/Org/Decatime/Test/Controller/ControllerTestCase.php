<?php

namespace Org\Decatime\Test\Controller;

class ControllerTestCase extends \PHPUnit_Framework_TestCase
{
    protected $app;

    public function setUp()
    {
        $this->app = new \Config\App();
    }

    protected function getCtrlArgs()
    {
        $c = $this->app->getContainer();
        return [
            'twig' => $c['twig'],
            'logger' => $c['logger'],
            'session' => $c['session'],
            'ema' => $c['ema']
        ];
    }
}
