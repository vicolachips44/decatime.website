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
        $this->assertEquals('Decatime - home', $crawler->filter('head > title')->text());
    }

    public function testArticleAction()
    {
        $home  = new HomeController($this->getCtrlArgs());
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/articles/1/view',
            'QUERY_STRING'=>''
        ]);
        $request = Request::createFromEnvironment($env);
        $response = $home->viewArticleAction($request, new Response(), ['id' => 1]);
        $html = (String) $response->getBody();
        $crawler = new Crawler($html);
        $this->assertEquals('Installation de nodeJS', $crawler->filter('head > title')->text());
    }
}
