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
        $repo = $this->ema->getRepository('Org\Decatime\Entity\Article');

        $articles = $repo->loadLatestArticles();
        return $this->render(
            $response,
            'index.html.twig',
            [
                'page_title' => 'Decatime - home',
                'articles' => $articles
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
        if ($isNew && !$request->isPost()) {
            return $this->articleEditorView(new Article(), $response);
        }

        $article = $isNew ? new Article() : $repo->loadArticle($args['id']);

        if ($request->isPost()) {
            $adapter = new ArticleAdapter($article);

            if ($adapter->hydrateFromRequest($request)) {
                $this->ema->persist($article);
                $this->ema->flush();
                return $response->withRedirect(
                    $this->router->pathFor('article_edit', ['id' => $article->getId()])
                );
            }
        }
        return $this->articleEditorView($article, $response);
    }

    protected function articleEditorView(Article $article, Response $response)
    {
        return $this->render(
            $response,
            'articles/edit.html.twig',
            [
                'article' => json_encode($article),
                'article_id' => $article->getId()
            ]
        );
    }
}
