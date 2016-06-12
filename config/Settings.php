<?php

namespace Config;

trait Settings
{
    private function loadSettings()
    {
        return [
            'settings' => [
                'displayErrorDetails' => !! getenv('DBG_MODE'), // set to false in production
                'sessionDir' => __DIR__.'/../cache/phpSession',

                // Renderer settings
                'twig' => [
                    'viewsPath' => __DIR__.'/../src/Org/Decatime/views',
                    'cachePath' => __DIR__.'/../cache/twig',
                ],

                // Monolog settings
                'logger' => [
                    'name' => 'decatime-app',
                    'path' => __DIR__ . '/../logs/decatime.log',
                ],
                'database' => [
                    'entityPath' => __DIR__.'/../src/Org/Decatime/Entity',
                    'cachePath' => __DIR__.'/../cache/doctrine',
                    'dbparams' => [
                        'driver' => getenv('DB_DRIVER'),
                        'user' => getenv('DB_USER'),
                        'password' => getenv('DB_PWD'),
                        'path' => __DIR__.'/../'.getenv('DB_PATH')
                    ]
                ]
            ],
        ];
    }
}
