<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Time
 */
class Time
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString() {
        return $this->getName();
    }
    /**
     * @var PDS\StoryBundle\Entity\Story
     */
    private $Stories;

    public function __construct()
    {
        $this->Stories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add Stories
     *
     * @param PDS\StoryBundle\Entity\Story $stories
     */
    public function addStory(\PDS\StoryBundle\Entity\Story $stories)
    {
        $this->Stories[] = $stories;
    }

    /**
     * Get Stories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStories()
    {
        return $this->Stories;
    }
}