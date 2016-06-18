<?php

namespace Org\Decatime\Controller;

use Interop\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Views\Twig;
use Monolog\Logger;
use RKA\Session;

abstract class AbstractController
{
    const R_ARTICLE = 'Org\Decatime\Entity\Article';
    const R_CHAPTER = 'Org\Decatime\Entity\Chapter';

    protected $twig;
    protected $logger;
    protected $session;
    protected $ema;
    protected $router;
    protected $imageManager;

    public function __construct($container)
    {
        $this->twig = $container->get('twig');
        $this->logger = $container->get('logger');
        $this->session = $container->get('session');
        $this->ema = $container->get('ema');
        $this->router = $container->get('router');
        $this->imageManager = $container->get('imageManager');
    }

    protected function render(Response $response, $template, array $viewArgs = [])
    {
        $args = \array_merge($viewArgs, ['adminSession' => $this->session->get('admin-auth')]);
        return $this->twig->render($response, $template, $args);
    }
}
