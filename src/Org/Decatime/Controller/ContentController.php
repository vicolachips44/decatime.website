<?php

namespace Org\Decatime\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

use Org\Decatime\Adapter\ContentAdapter;
use Org\Decatime\Entity\Content;

class ContentController extends AbstractController
{
    public function saveAction(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $repo = $this->ema->getRepository(self::R_CHAPTER);
        $chapter = $repo->find($data['chapter_id']);
        $content = new Content();
        $adapter = new ContentAdapter($content);
        $adapter->hydrate($data['content']);
        $chapter->addContent($content);
        $content->setChapter($chapter);

        $this->ema->persist($content);
        $this->ema->flush();

        return $response->withJson(['id' => $content->getId()]);
    }
}
