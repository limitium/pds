<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Comment
 */
class Comment
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var text $message
     */
    private $message;

    /**
     * @var datetime $created_at
     */
    private $created_at;

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
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
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