<?php

namespace Org\Decatime\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;

use Org\Decatime\Adapter\ArticleAdapter;
use Org\Decatime\Adapter\ChapterAdapter;
use Org\Decatime\Entity\Article;
use Org\Decatime\Entity\Chapter;

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
        $repo = $this->ema->getRepository(self::R_ARTICLE);

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
        $repo = $this->ema->getRepository(self::R_ARTICLE);

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
        $repo = $this->ema->getRepository(self::R_ARTICLE);
        $isNew = !isset($args['id']);
        if ($isNew && !$request->isPost()) {
            return $this->articleEditorView(new Article(), $response);
        }

        $article = $isNew ? new Article() : $repo->loadArticle($args['id']);

        if ($request->isPost()) {
            $adapter = new ArticleAdapter($article, $this->imageManager);

            if ($adapter->hydrate($request->getParsedBody(), $request->getUploadedFiles())) {
                $this->ema->persist($article);
                $this->ema->flush();
                return $response->withRedirect(
                    $this->router->pathFor('article_edit', ['id' => $article->getId()])
                );
            }
        }
        return $this->articleEditorView($article, $response);
    }

    public function ajaxSaveChapterAction(Request $request, Response $response)
    {
        if ($request->isXhr() === false) {
            return $response->withStatus(400);
        }

        $data = $request->getParsedBody();
        $repo = $this->ema->getRepository(self::R_ARTICLE);
        $article = $repo->find($data['article_id']);
        $chapter = new Chapter();
        $adapter = new ChapterAdapter($chapter);
        $adapter->hydrate($data['chapter']);
        $article->addChapter($chapter);
        $chapter->setArticle($article);

        $this->ema->persist($chapter);
        $this->ema->flush();

        return $response->withJson(['id' => $chapter->getId()]);
    }

    public function ajaxDeleteChapterAction(Request $request, Response $response)
    {
        if ($request->isXhr() === false) {
            return $response->withStatus(400);
        }
        $data = $request->getParsedBody();
        $repo = $this->ema->getRepository(self::R_CHAPTER);
        $chapter = $repo->find($data['id']);
        $article_id = $chapter->getArticle()->getId();
        $deletedPosition = $chapter->getPosition();
        $this->ema->remove($chapter);
        $this->ema->flush();

        $this->ema->getRepository(self::R_ARTICLE)
            ->reorderChapters($article_id, $deletedPosition);

        return $response->withJson(['status' => 'ok']);
    }

    public function ajaxUpdateChapterAction(Request $request, Response $response)
    {
        if ($request->isXhr() === false) {
            return $response->withStatus(400);
        }
        $data = $request->getParsedBody();
        $repo = $this->ema->getRepository(self::R_CHAPTER);
        $chapter = $repo->find($data['id']);
        $adapter = new ChapterAdapter($chapter);
        $adapter->hydrate($data);
        $this->ema->persist($chapter);
        $this->ema->flush();
        return $response->withJson(['status' => 'ok']);
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
