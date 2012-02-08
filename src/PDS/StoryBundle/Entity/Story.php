<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Story
 */
class Story
{
   
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var text $body
     */
    private $body;

    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * @var date $date
     */
    private $date;

    /**
     * @var PDS\StoryBundle\Entity\Vote
     */
    private $Votes;

    /**
     * @var PDS\StoryBundle\Entity\Comment
     */
    private $Comments;

    /**
     * @var PDS\UserBundle\Entity\User
     */
    private $User;

    /**
     * @var PDS\StoryBundle\Entity\Country
     */
    private $Country;

    /**
     * @var PDS\StoryBundle\Entity\Topic
     */
    private $Topics;

    public function __construct()
    {
        $this->Votes = new \Doctrine\Common\Collections\ArrayCollection();
    $this->Comments = new \Doctrine\Common\Collections\ArrayCollection();
    $this->Topics = new \Doctrine\Common\Collections\ArrayCollection();
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
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add Votes
     *
     * @param PDS\StoryBundle\Entity\Vote $votes
     */
    public function addVote(\PDS\StoryBundle\Entity\Vote $votes)
    {
        $this->Votes[] = $votes;
    }

    /**
     * Get Votes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->Votes;
    }

    /**
     * Add Comments
     *
     * @param PDS\StoryBundle\Entity\Comment $comments
     */
    public function addComment(\PDS\StoryBundle\Entity\Comment $comments)
    {
        $this->Comments[] = $comments;
    }

    /**
     * Get Comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->Comments;
    }

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

    /**
     * Set Country
     *
     * @param PDS\StoryBundle\Entity\Country $country
     */
    public function setCountry(\PDS\StoryBundle\Entity\Country $country)
    {
        $this->Country = $country;
    }

    /**
     * Get Country
     *
     * @return PDS\StoryBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * Add Topics
     *
     * @param PDS\StoryBundle\Entity\Topic $topics
     */
    public function addTopic(\PDS\StoryBundle\Entity\Topic $topics)
    {
        $this->Topics[] = $topics;
    }

    /**
     * Get Topics
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTopics()
    {
        return $this->Topics;
    }


    /**
     * @return string
     */
    public function getRating(){
        $total=0;
        foreach($this->getVotes() as $vote){
            $total += $vote->getValue();
        }
        return number_format(sizeof($this->Votes)?($total/sizeof($this->Votes)):0,2,'.','');
    }
    /**
     * @var PDS\StoryBundle\Entity\Time
     */
    private $Time;


    /**
     * Set Time
     *
     * @param PDS\StoryBundle\Entity\Time $time
     */
    public function setTime(\PDS\StoryBundle\Entity\Time $time)
    {
        $this->Time = $time;
    }

    /**
     * Get Time
     *
     * @return PDS\StoryBundle\Entity\Time 
     */
    public function getTime()
    {
        return $this->Time;
    }
}