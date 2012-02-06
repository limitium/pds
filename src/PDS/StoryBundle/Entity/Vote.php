<?php

namespace PDS\StoryBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Max(limit = 5, message = "lolwhat?")
     * @Assert\Min(limit = 1, message = "lolwhat?")
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
     * @param PDS\UserBundle\Entity\User $user
     */
    public function setUser(\PDS\UserBundle\Entity\User $user)
    {
        $this->User = $user;
    }

    /**
     * Get User
     *
     * @return PDS\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }
}