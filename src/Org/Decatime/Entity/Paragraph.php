<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Paragraph
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * raw content
     * @ORM\Column(type="blob", nullable=true)
     */
    private $rawData;

    /**
     * textual data
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $data;

    /**
     * Version of content
     * @ORM\Column(type="integer")
     */
    private $version = 1;

    /**
     * position of Chapter
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * Type of content
     * @ORM\ManyToOne(targetEntity="ContentType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * Format of content
     * @ORM\ManyToOne(targetEntity="Format")
     * @ORM\JoinColumn(name="format_id", referencedColumnName="id")
     */
    private $format;

    /**
     * Content of paragraph
     * @ORM\ManyToOne(targetEntity="Content", inversedBy="paragraphs")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     */
    private $content;

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
     * Set rawData
     *
     * @param string $rawData
     *
     * @return Paragraph
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;

        return $this;
    }

    /**
     * Get rawData
     *
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    public function getEncodedRawData()
    {
        return base64_encode(stream_get_contents($this->rawData));
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Paragraph
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Paragraph
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Paragraph
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
     * Set type
     *
     * @param \Org\Decatime\Entity\ContentType $type
     *
     * @return Paragraph
     */
    public function setType(\Org\Decatime\Entity\ContentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Org\Decatime\Entity\ContentType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set format
     *
     * @param \Org\Decatime\Entity\Format $format
     *
     * @return Paragraph
     */
    public function setFormat(\Org\Decatime\Entity\Format $format = null)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return \Org\Decatime\Entity\Format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set content
     *
     * @param \Org\Decatime\Entity\Content $content
     *
     * @return Paragraph
     */
    public function setContent(\Org\Decatime\Entity\Content $content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return \Org\Decatime\Entity\Content
     */
    public function getContent()
    {
        return $this->content;
    }
}
