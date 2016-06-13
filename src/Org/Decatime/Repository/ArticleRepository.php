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
}
