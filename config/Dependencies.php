<?php

namespace Config;

trait Dependencies
{
    private function initDependencies()
    {
        $container = $this->getContainer();

        // view renderer
        $container['twig'] = function ($c) {
            $settings = $c->get('settings')['twig'];
            $debug = $c->get('settings')['displayErrorDetails'];

            $twig = new \Slim\Views\Twig(
                $settings['viewsPath'],
                [
                    'cache' => $debug ? false : $settings['cachePath']
                ]
            );

            $twig->addExtension(new \Slim\Views\TwigExtension(
                $c['router'],
                $c['request']->getUri()
            ));
            $twig['debug_mode'] = $debug;

            return $twig;
        };

        // monolog
        $container['logger'] = function ($c) {
            $settings = $c->get('settings')['logger'];
            $logger = new \Monolog\Logger($settings['name']);
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], \Monolog\Logger::DEBUG));
            return $logger;
        };

        // session
        $container['session'] = function ($c) {
            $session = new \RKA\Session();
            return $session;
        };

        $container['sessionMiddleware'] = function ($c) {
            return new \RKA\SessionMiddleware(
                [
                    'name' => 'decatimeSession',
                    'path' => $c->get('settings')['sessionDir'],
                ]
            );
        };

        // doctrine
        $container['ema'] = function ($c) {
            $settings = $c->get('settings')['database'];
            $config = null;
            $debug = $c->get('settings')['displayErrorDetails'];

            if ($debug) {
                $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
                    [$settings['entityPath']],
                    true,
                    $settings['cachePath']
                );
            } else {
                $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
                    [$settings['entityPath']],
                    false
                );
            }
            $driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
                new \Doctrine\Common\Annotations\AnnotationReader(),
                [$settings['entityPath']]
            );

            $config->setMetadataDriverImpl($driver);

            $ema = \Doctrine\ORM\EntityManager::create($settings['dbparams'], $config);
            return $ema;
        };

        // image manager service
        $container['imageManager'] = function ($c) {
            return new \Intervention\Image\ImageManager();
        };

        $container['privateFirewall'] = function ($c) {
            return new \Org\Decatime\Middleware\PrivateFirewall($c->get('session'));
        };

        $container['ctrl_base'] = function ($c) {
            return [
                'twig' => $c->get('twig'),
                'logger' => $c->get('logger'),
                'session' => $c->get('session'),
                'ema' => $c->get('ema'),
                'router' => $c->get('router'),
                'imageManager' => $c->get('imageManager')
            ];
        };

        // controllers - BEGIN
        $container['MainController'] = function ($c) {
            return new \Org\Decatime\Controller\MainController($c->get('ctrl_base'));
        };
        $container['PrivateController'] = function ($c) {
            return new \Org\Decatime\Controller\PrivateController($c->get('ctrl_base'));
        };
        // controllers - END
    }
}
