<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Chapter
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
     * position of Chapter
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * contents of chapter
     * @ORM\OneToMany(targetEntity="Content", mappedBy="chapter")
     */
    private $contents;

    /**
     * child chapters
     * @ORM\OneToMany(targetEntity="Chapter", mappedBy="parent")
     */
    private $chapters;

    /**
     * parent chapter
     * @ORM\ManyToOne(targetEntity="Chapter")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * parent article
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=true)
     */
    private $article;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->chapters = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Chapter
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
     * Set position
     *
     * @param integer $position
     *
     * @return Chapter
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add content
     *
     * @param \Org\Decatime\Entity\Content $content
     *
     * @return Chapter
     */
    public function addContent(\Org\Decatime\Entity\Content $content)
    {
        $this->contents[] = $content;

        return $this;
    }

    /**
     * Remove content
     *
     * @param \Org\Decatime\Entity\Content $content
     */
    public function removeContent(\Org\Decatime\Entity\Content $content)
    {
        $this->contents->removeElement($content);
    }

    /**
     * Get contents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Add chapter
     *
     * @param \Org\Decatime\Entity\Chapter $chapter
     *
     * @return Chapter
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
     * Set parent
     *
     * @param \Org\Decatime\Entity\Chapter $parent
     *
     * @return Chapter
     */
    public function setParent(\Org\Decatime\Entity\Chapter $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Org\Decatime\Entity\Chapter
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set article
     *
     * @param \Org\Decatime\Entity\Article $article
     *
     * @return Chapter
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
}
