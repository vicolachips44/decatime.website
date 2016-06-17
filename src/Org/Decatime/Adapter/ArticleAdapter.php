<?php

namespace Org\Decatime\Adapter;

use Org\Decatime\Entity\Article;
use Intervention\Image\ImageManager;

final class ArticleAdapter
{
    private $article;
    private $imageManager;

    public function __construct(Article $article, ImageManager $imageManager)
    {
        $this->article = $article;
        $this->imageManager = $imageManager;
    }

    public function hydrate(array $args, array $files)
    {
        $this->processProperties($args);
        $this->processUploadedFiles($files);

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
            if ($uploadedFile->file === '') {
                continue;
            }

            $raw = $this->imageManager->make($uploadedFile->file);
            if ($key === 'article_small_image') {
                $this->article->setSmallImage($raw->resize(120, 80)->encode('png', 70));
            } else {
                $this->article->setBigImage($raw->resize(400, 300)->encode('png', 70));
            }
        }
    }
}
