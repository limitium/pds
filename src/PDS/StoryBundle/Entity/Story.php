<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DoctrineExtensions\Taggable\Taggable;

/**
 * PDS\StoryBundle\Entity\Story
 */
class Story implements Taggable
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
     * @Assert\MaxLength(
     *     limit=30,
     *     message="Maximum topics size is {{ limit }} characters."
     * )
     * @var PDS\StoryBundle\Entity\Topic
     */
    private $Topics;

    public function __construct()
    {
        $this->Votes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Topics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Pages = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * @var text $meta
     */
    private $meta;

    /**
     * @var integer $status
     */
    private $status;

    /**
     * @var PDS\StoryBundle\Entity\Page
     */
    private $Pages;


    /**
     * Set meta
     *
     * @param text $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * Get meta
     *
     * @return text 
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Add Pages
     *
     * @param PDS\StoryBundle\Entity\Page $pages
     */
    public function addPage(\PDS\StoryBundle\Entity\Page $pages)
    {
        $this->Pages[] = $pages;
    }

    /**
     * Get Pages
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->Pages;
    }

    /**
     * Set Pages
     *
     * @param Doctrine\Common\Collections\ArrayCollection  $pages
     */
    public function setPages(\Doctrine\Common\Collections\ArrayCollection $pages) {
        $this->Pages = $pages;
    }


    public function removePage(\Pds\StoryBundle\Entity\Page $page) {
        $this->Pages->removeElement($page);
    }

    /**
     * Set Pages
     *
     * @param Doctrine\Common\Collections\ArrayCollection  $topics
     */
    public function setTopics($topics) {
        $this->Topics = $topics;
    }


    public function __toString()
    {
        return $this->title;
    }

    /**
     * Returns the unique taggable resource type
     *
     * @return string
     */
    function getTaggableType()
    {
        return "story";
    }

    /**
     * Returns the unique taggable resource identifier
     *
     * @return string
     */
    function getTaggableId()
    {
        return $this->getId();
    }

    private $tags;
    /**
     * Returns the collection of tags for this Taggable entity
     *
     * @return Doctrine\Common\Collections\Collection
     */
    function getTags()
    {
        $this->tags = $this->tags ?: new \Doctrine\Common\Collections\ArrayCollection();

        return $this->tags;
    }
    /**
     * @var text $meta_place
     */
    private $meta_place;

    /**
     * @var PDS\StoryBundle\Entity\Status
     */
    private $Status;


    /**
     * Set meta_place
     *
     * @param text $metaPlace
     */
    public function setMetaPlace($metaPlace)
    {
        $this->meta_place = $metaPlace;
    }

    /**
     * Get meta_place
     *
     * @return text 
     */
    public function getMetaPlace()
    {
        return $this->meta_place;
    }

    /**
     * Set Status
     *
     * @param PDS\StoryBundle\Entity\Status $status
     */
    public function setStatus(\PDS\StoryBundle\Entity\Status $status)
    {
        $this->Status = $status;
    }

    /**
     * Get Status
     *
     * @return PDS\StoryBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->Status;
    }
    /**
     * @var text $meta_storyteller
     */
    private $meta_storyteller;

    /**
     * @var text $meta_time
     */
    private $meta_time;


    /**
     * Set meta_storyteller
     *
     * @param text $metaStoryteller
     */
    public function setMetaStoryteller($metaStoryteller)
    {
        $this->meta_storyteller = $metaStoryteller;
    }

    /**
     * Get meta_storyteller
     *
     * @return text 
     */
    public function getMetaStoryteller()
    {
        return $this->meta_storyteller;
    }

    /**
     * Set meta_time
     *
     * @param text $metaTime
     */
    public function setMetaTime($metaTime)
    {
        $this->meta_time = $metaTime;
    }

    /**
     * Get meta_time
     *
     * @return text 
     */
    public function getMetaTime()
    {
        return $this->meta_time;
    }
}