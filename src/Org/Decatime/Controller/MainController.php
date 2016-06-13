<?php

namespace Org\Decatime\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;

use Org\Decatime\Adapter\ArticleAdapter;
use Org\Decatime\Entity\Article;

class MainController extends AbstractController
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
                'page_title' => 'Decatime - home'
            ]
        );
    }

    /**
     * viewAction handler.
     *
     * {@inheritdoc}
     */
    public function viewAction(Request $request, Response $response, array $args)
    {
        $repo = $this->ema->getRepository('Org\Decatime\Entity\Article');

        $article = $repo->loadArticle($args['id']);

        return $this->render(
            $response,
            'articles/view.html.twig',
            [
                'article' => $article
            ]
        );
    }

    /**
     * editAction handler.
     *
     * {@inheritdoc}
     */

    public function editAction(Request $request, Response $response, array $args)
    {
        $repo = $this->ema->getRepository('Org\Decatime\Entity\Article');
        $isNew = !isset($args['id']);
        $article = new Article();
        if (!$isNew) {
            $article = $repo->find($args['id']);
        }

        return $this->render(
            $response,
            'articles/edit.html.twig',
            [
                'article' => $article
            ]
        );

    }
}
