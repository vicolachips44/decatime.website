<?php

namespace Org\Decatime\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class XhrOnly
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        if ($request->isXhr() === false) {
            return $response->withStatus(400);
        }
        return $next($request, $response);
    }
}
