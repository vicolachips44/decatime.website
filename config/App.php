<?php

namespace Config;

final class App extends \Slim\App
{
    public function __construct()
    {
        $this->initEnv();
        parent::__construct($this->loadSettings());
        $this->initDependencies();
        $this->initMiddlewares();
        $this->initEmaEvents();

        Routes::getInstance()->load($this);
    }

    private function initEnv()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__);
        $dotenv->load();

        $dotenv->required('DBG_MODE')->isInteger();
        $dotenv->required('ADM_PWD')->notEmpty();
        $dotenv->required('DB_DRIVER')->notEmpty();
        $dotenv->required('DB_USER')->notEmpty();
        $dotenv->required('DB_PWD');
        $dotenv->required('DB_PATH');
    }

    use Settings;

    use Dependencies;

    private function initMiddlewares()
    {
        $this->add('sessionMiddleware');
    }

    private function initEmaEvents()
    {
        $eventBus = $this->getContainer()->get('ema_events');
        $eventBus->addEventListener(
            [
                \Doctrine\ORM\Events::postRemove
            ],
            new \Org\Decatime\Event\EntityListener()
        );
    }
}
