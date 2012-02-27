<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Page
 */
class Page
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var text $body
     */
    private $body;

    /**
     * @var integer $lineno
     */
    private $lineno;

    /**
     * @var PDS\StoryBundle\Entity\Story
     */
    private $Story;


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
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set lineno
     *
     * @param integer $lineno
     */
    public function setLineno($lineno)
    {
        $this->lineno = $lineno;
    }

    /**
     * Get lineno
     *
     * @return integer 
     */
    public function getLineno()
    {
        return $this->lineno;
    }

    /**
     * Set Story
     *
     * @param PDS\StoryBundle\Entity\Story $story
     */
    public function setStory(\PDS\StoryBundle\Entity\Story $story)
    {
        $this->Story = $story;
    }

    /**
     * Get Story
     *
     * @return PDS\StoryBundle\Entity\Story 
     */
    public function getStory()
    {
        return $this->Story;
    }
}