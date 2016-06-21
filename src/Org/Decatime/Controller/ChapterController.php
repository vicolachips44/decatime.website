<?php

namespace Org\Decatime\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

use Org\Decatime\Entity\Chapter;
use Org\Decatime\Adapter\ChapterAdapter;

class ChapterController extends AbstractController
{
    public function saveAction(Request $request, Response $response)
    {
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

    public function updateAction(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $repo = $this->ema->getRepository(self::R_CHAPTER);
        $chapter = $repo->find($data['id']);
        $adapter = new ChapterAdapter($chapter);
        $adapter->hydrate($data);
        $this->ema->persist($chapter);
        $this->ema->flush();
        return $response->withJson(['status' => 'ok']);
    }

    public function deleteAction(Request $request, Response $response)
    {
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
}
