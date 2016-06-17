<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Content implements \JsonSerializable
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * position of Chapter
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * Contents of paragraph
     * @ORM\OneToMany(targetEntity="Paragraph", mappedBy="content", cascade={"persist", "remove"})
     */
    private $paragraphs;

    /**
     * chapter of content
     * @ORM\ManyToOne(targetEntity="Chapter")
     * @ORM\JoinColumn(name="chapter_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $chapter;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paragraphs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Content
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
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Content
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Content
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
     * Add paragraph
     *
     * @param \Org\Decatime\Entity\Paragraph $paragraph
     *
     * @return Content
     */
    public function addParagraph(\Org\Decatime\Entity\Paragraph $paragraph)
    {
        $this->paragraphs[] = $paragraph;

        return $this;
    }

    /**
     * Remove paragraph
     *
     * @param \Org\Decatime\Entity\Paragraph $paragraph
     */
    public function removeParagraph(\Org\Decatime\Entity\Paragraph $paragraph)
    {
        $this->paragraphs->removeElement($paragraph);
    }

    /**
     * Get paragraphs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParagraphs()
    {
        return $this->paragraphs;
    }

    /**
     * Set chapter
     *
     * @param \Org\Decatime\Entity\Chapter $chapter
     *
     * @return Content
     */
    public function setChapter(\Org\Decatime\Entity\Chapter $chapter = null)
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * Get chapter
     *
     * @return \Org\Decatime\Entity\Chapter
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    public function jsonSerialize()
    {
        $aparagraphs = [];
        foreach ($this->paragraphs as $paragraph) {
            $aparagraphs[] = json_encode($paragraph);
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'position' => $this->position,
            'paragraphs' => $aparagraphs
        ];
    }
}
