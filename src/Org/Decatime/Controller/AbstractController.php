<?php

namespace Org\Decatime\Controller;

use Interop\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Views\Twig;
use Monolog\Logger;
use RKA\Session;

abstract class AbstractController
{
    protected $twig;
    protected $logger;
    protected $session;
    protected $ema;
    protected $router;

    public function __construct(array $dependencies)
    {
        $this->twig = $dependencies['twig'];
        $this->logger = $dependencies['logger'];
        $this->session = $dependencies['session'];
        $this->ema = $dependencies['ema'];
        $this->router = $dependencies['router'];
    }

    protected function render(Response $response, $template, array $viewArgs = [])
    {
        $args = \array_merge($viewArgs, ['adminSession' => $this->session->get('admin-auth')]);
        return $this->twig->render($response, $template, $args);
    }
}
