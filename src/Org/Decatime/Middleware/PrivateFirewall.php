<?php

namespace Org\Decatime\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PrivateFirewall
{
    private $session;

    public function __construct(\RKA\Session $session)
    {
        $this->session = $session;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $route = $request->getAttribute('route');
        if ($route->getName() === 'private_login') {
            return $next($request, $response);
        }

        // If secured session does not exists
        if ($this->session->get('admin-auth') !== true) {
            $response->getBody()->write('Protected area...');
            return $response->withStatus(403);
        }

        return $next($request, $response);
    }
}
