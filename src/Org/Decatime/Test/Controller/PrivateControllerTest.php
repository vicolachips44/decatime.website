<?php

namespace Org\Decatime\Test\Controller;

use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\DomCrawler\Crawler;

use Org\Decatime\Controller\PrivateController;

class PrivateControllerTest extends ControllerTestCase
{
    public function setUp()
    {
        parent::setup();
    }

    public function testAdminActionFails()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/private/admin'
        ]);

        $request = Request::createFromEnvironment($env);
        $routes = $this->app->getContainer()->get('router');
        $private_route = $routes->getNamedRoute('private_admin');
        $request = $request->withAttribute('route', $private_route);
        $response = $private_route->run($request, new Response());
        $this->assertEquals('Protected area...', (String) $response->getBody());
        $this->assertEquals($response->getStatusCode(), 403);
    }

    public function testLoginAction()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/private/login'
        ]);

        $request = Request::createFromEnvironment($env);
        $request = $request->withParsedBody([
            'login' => 'admin',
            'pwd' => 'null'
        ]);

        $routes = $this->app->getContainer()->get('router');
        $private_route = $routes->getNamedRoute('private_login');
        $request = $request->withAttribute('route', $private_route);
        $response = $private_route->run($request, new Response());
        $retvalue = json_decode((String) $response->getBody());
        $this->assertTrue($retvalue->status === 'KO');

        $request = $request->withParsedBody([]);
        $response = $private_route->run($request, new Response());
        $retvalue = json_decode((String) $response->getBody());
        $this->assertTrue($retvalue->status === 'OK');

        $request = $request->withParsedBody([
            'login' => 'admin',
            'pwd' => getenv('ADM_PWD')
        ]);
        $response = $private_route->run($request, new Response());
        $retvalue = json_decode((String) $response->getBody());
        $this->assertTrue($retvalue->status === 'OK');

    }

    public function testAdminAction()
    {

        $env = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/private/login'
        ]);

        $request = Request::createFromEnvironment($env);
        $request = $request->withParsedBody([
            'login' => 'admin',
            'pwd' => getenv('ADM_PWD')
        ]);

        $routes = $this->app->getContainer()->get('router');
        $private_route = $routes->getNamedRoute('private_login');
        $request = $request->withAttribute('route', $private_route);

        $response = $private_route->run($request, new Response());
        $this->assertTrue($this->app->getContainer()['session']->get('admin-auth'));

        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/private/admin'
        ]);

        $request = Request::createFromEnvironment($env);
        $routes = $this->app->getContainer()->get('router');
        $private_route = $routes->getNamedRoute('private_admin');
        $request = $request->withAttribute('route', $private_route);
        $response = $private_route->run($request, new Response());
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
