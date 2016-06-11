<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $publishedAt;

    /**
     * Short description
     * @ORM\Column(type="text")
     */
    private $shortDescription;

    /**
     * raw content
     * @ORM\Column(type="blob", nullable=true)
     */
    private $smallImage;

    /**
     * raw content
     * @ORM\Column(type="blob", nullable=true)
     */
    private $bigImage;

    /**
     * child chapters
     * @ORM\OneToMany(targetEntity="Chapter", mappedBy="article")
     */
    private $chapters;

    /**
     * article topics
     * @ORM\OneToMany(targetEntity="ArticleTopic", mappedBy="article")
     */
    private $articleTopics;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chapters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articleTopics = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Article
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Article
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Add chapter
     *
     * @param \Org\Decatime\Entity\Chapter $chapter
     *
     * @return Article
     */
    public function addChapter(\Org\Decatime\Entity\Chapter $chapter)
    {
        $this->chapters[] = $chapter;

        return $this;
    }

    /**
     * Remove chapter
     *
     * @param \Org\Decatime\Entity\Chapter $chapter
     */
    public function removeChapter(\Org\Decatime\Entity\Chapter $chapter)
    {
        $this->chapters->removeElement($chapter);
    }

    /**
     * Get chapters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * Add articleTopic
     *
     * @param \Org\Decatime\Entity\ArticleTopic $articleTopic
     *
     * @return Article
     */
    public function addArticleTopic(\Org\Decatime\Entity\ArticleTopic $articleTopic)
    {
        $this->articleTopics[] = $articleTopic;

        return $this;
    }

    /**
     * Remove articleTopic
     *
     * @param \Org\Decatime\Entity\ArticleTopic $articleTopic
     */
    public function removeArticleTopic(\Org\Decatime\Entity\ArticleTopic $articleTopic)
    {
        $this->articleTopics->removeElement($articleTopic);
    }

    /**
     * Get articleTopics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleTopics()
    {
        return $this->articleTopics;
    }

    /**
     * Set smallImage
     *
     * @param string $smallImage
     *
     * @return Article
     */
    public function setSmallImage($smallImage)
    {
        $this->smallImage = $smallImage;

        return $this;
    }

    /**
     * Get smallImage
     *
     * @return string
     */
    public function getSmallImage()
    {
        return $this->smallImage;
    }

    /**
     * Set bigImage
     *
     * @param string $bigImage
     *
     * @return Article
     */
    public function setBigImage($bigImage)
    {
        $this->bigImage = $bigImage;

        return $this;
    }

    /**
     * Get bigImage
     *
     * @return string
     */
    public function getBigImage()
    {
        return $this->bigImage;
    }
}
