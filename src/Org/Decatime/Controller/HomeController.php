<?php

namespace Org\Decatime\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;

class HomeController extends AbstractController
{
    /**
     * indexAction handler.
     *
     * {@inheritdoc}
     */
    public function indexAction(Request $request, Response $response, array $args)
    {
        $this->logger->log(Logger::DEBUG, 'Ce message appraît dans le log et dans le web!');
        return $this->render(
            $response,
            'index.html.twig',
            [
                'page_title' => 'welcome'
            ]
        );
    }

    /**
     * viewArticleAction handler.
     *
     * {@inheritdoc}
     */
    public function viewArticleAction(Request $request, Response $response, array $args)
    {
        $artRepo = $this->ema->getRepository('Org\Decatime\Entity\Article');
        $article = $artRepo->find($args['id']);
        return $this->render(
            $response,
            'article.html.twig',
            [
                'article' => $article
            ]
        );
    }
}
