<?php

namespace Org\Decatime\Test\Controller;

use Org\Decatime\Controller\HomeController;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\DomCrawler\Crawler;

class HomeControllerTest extends ControllerTestCase
{
    public function testIndexAction()
    {
        $home  = new HomeController($this->getCtrlArgs());
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/',
            'QUERY_STRING'=>''
        ]);
        $request = Request::createFromEnvironment($env);
        $response = $home->indexAction($request, new Response(), []);
        $html = (String) $response->getBody();
        $crawler = new Crawler($html);
        $this->assertEquals('welcome', $crawler->filter('head > title')->text());
    }
}
