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
        $app->get('/articles/view/{id:[0-9]+}', 'MainController:viewAction')
            ->setName('article_view');

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
        $app->map(['GET', 'POST'], '/articles/edit[/{id:[0-9]+}]', 'MainController:editAction')
            ->add('privateFirewall')
            ->setName('article_edit');

        // save chapter
        $app->post('/articles/ajax-save-chapter', 'MainController:ajaxSaveChapterAction')
            ->add('privateFirewall')
            ->add('xhr_only')
            ->setName('ajax_save_chapter');

        // delete chapter
        $app->post('/articles/ajax-delete-chapter', 'MainController:ajaxDeleteChapterAction')
            ->add('privateFirewall')
            ->add('xhr_only')
            ->setName('ajax_delete_chapter');

        // update chapter
        $app->post('/articles/ajax-update-chapter', 'MainController:ajaxUpdateChapterAction')
            ->add('privateFirewall')
            ->add('xhr_only')
            ->setName('ajax_update_chapter');
    }
}
