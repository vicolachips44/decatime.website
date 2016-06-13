<?php

namespace Org\Decatime\Adapter;

use Org\Decatime\Entity\Article;
use Slim\Http\Request;

final class ArticleAdapter
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function hydrateFromRequest(Request $request)
    {
        $this->processProperties($request->getParsedBody());
        $this->processUploadedFiles($request->getUploadedFiles());

        return true;
    }

    private function processProperties(array $properties)
    {
        $this->article->setTitle($properties['article_title']);
        $this->article->setShortDescription($properties['article_short_description']);
        if ($this->article->getCreatedAt() === null) {
            $this->article->setCreatedAt(new \DateTime());
        }
    }

    private function processUploadedFiles(array $uploadedFiles)
    {
        foreach ($uploadedFiles as $key => $uploadedFile) {
            if ($uploadedFile->file !== '') {
                $raw = file_get_contents($uploadedFile->file);
                if ($key === 'article_small_image') {
                    $this->article->setSmallImage($raw);
                } else {
                    $this->article->setBigImage($raw);
                }
            }
        }
    }
}
