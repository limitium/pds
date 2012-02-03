<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Vote
 */
class Vote
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $value
     */
    private $value;

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
     * Set value
     *
     * @param integer $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
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
    /**
     * @var PDS\StoryBundle\Entity\User
     */
    private $User;


    /**
     * Set User
     *
     * @param PDS\StoryBundle\Entity\User $user
     */
    public function setUser(\PDS\StoryBundle\Entity\User $user)
    {
        $this->User = $user;
    }

    /**
     * Get User
     *
     * @return PDS\StoryBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->User;
    }
}