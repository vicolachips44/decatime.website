<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class ArticleTopic
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * parent chapter
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * parent chapter
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     */
    private $topic;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set article
     *
     * @param \Org\Decatime\Entity\Article $article
     *
     * @return ArticleTopic
     */
    public function setArticle(\Org\Decatime\Entity\Article $article = null)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * Get article
     *
     * @return \Org\Decatime\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set topic
     *
     * @param \Org\Decatime\Entity\Topic $topic
     *
     * @return ArticleTopic
     */
    public function setTopic(\Org\Decatime\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \Org\Decatime\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }
}
