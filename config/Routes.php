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
        $app->get('/', 'MainController:indexAction');

        // view articles
        $app->get('/articles/view/{id:[0-9]+}', 'MainController:viewAction');

        // login admin
        $app->group(
            '/private',
            function () {
                $this->post('/login', 'PrivateController:loginAction')
                    ->setName('private_login');
                $this->get('/admin', 'PrivateController:adminAction')
                    ->setName('private_admin');
            }
        )->add('privateFirewall');

        // edit article
        $app->get('/articles/edit[/{id:[0-9]+}]', 'MainController:editAction')
            ->add('privateFirewall');
    }
}
