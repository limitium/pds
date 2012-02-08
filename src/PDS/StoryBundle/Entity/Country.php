<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Country
 */
class Country
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
     * @var PDS\StoryBundle\Entity\Story
     */
    private $Storeis;

    public function __construct()
    {
        $this->Storeis = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add Storeis
     *
     * @param PDS\StoryBundle\Entity\Story $storeis
     */
    public function addStory(\PDS\StoryBundle\Entity\Story $storeis)
    {
        $this->Storeis[] = $storeis;
    }

    /**
     * Get Storeis
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStoreis()
    {
        return $this->Storeis;
    }

    public function __toString() {
        return $this->getName();
    }
}