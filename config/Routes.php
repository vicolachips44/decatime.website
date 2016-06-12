<?php

namespace Config;

final class Routes
{
    private static $instance;

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Routes();
        }
        return self::$instance;
    }

    public function load($app)
    {
        // home
        $app->get('/', 'HomeController:indexAction');

        // private group begin
        $app->group(
            '/private',
            function () {
                $this->post('/login', 'PrivateController:loginAction')
                    ->setName('private_login');
                $this->get('/admin', 'PrivateController:adminAction')
                    ->setName('private_admin');
            }
        )->add(
            new \Org\Decatime\Middleware\PrivateMiddleware(
                $app->getContainer()->get('session')
            )
        );
        // private group end
    }
}
