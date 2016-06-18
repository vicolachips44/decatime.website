<?php

namespace Org\Decatime\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{

    public function loadArticle($id)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT a FROM Org\Decatime\Entity\Article a
                left join a.chapters chapter
                left join chapter.contents content
                left join content.paragraphs paragraph
                WHERE a.id = :id
                ORDER BY chapter.position, content.position, paragraph.position
            ')
            ->setParameter('id', $id);

        $results = $query->getResult();
        if (count($results) === 0) {
            return null;
        }
        return $results[0];
    }

    public function loadLatestArticles()
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT a FROM Org\Decatime\Entity\Article a
                WHERE a.publishedAt is not null
                ORDER BY a.createdAt desc
            ')
            ->setMaxResults(3);

        return $query->getResult();
    }

    public function reorderChapters($article_id, $deletedPosition)
    {
        $article = $this->find($article_id);

        $query = $this->getEntityManager()
            ->createQuery('
                UPDATE Org\Decatime\Entity\Chapter c
                SET c.position = c.position - 1
                WHERE c.article = :article
                AND c.position > :position
            ')
            ->setParameter('article', $article)
            ->setParameter('position', $deletedPosition);

        return $query->execute();
    }
}
