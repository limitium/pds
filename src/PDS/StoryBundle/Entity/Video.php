<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\StoryBundle\Entity\Video
 */
class Video
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $vid
     */
    private $vid;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $player_url
     */
    private $player_url;

    /**
     * @var string $watch_url
     */
    private $watch_url;

    /**
     * @var PDS\UserBundle\Entity\User
     */
    private $User;


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
     * Set vid
     *
     * @param string $vid
     */
    public function setVid($vid)
    {
        $this->vid = $vid;
    }

    /**
     * Get vid
     *
     * @return string 
     */
    public function getVid()
    {
        return $this->vid;
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
     * Set player_url
     *
     * @param string $playerUrl
     */
    public function setPlayerUrl($playerUrl)
    {
        $this->player_url = $playerUrl;
    }

    /**
     * Get player_url
     *
     * @return string 
     */
    public function getPlayerUrl()
    {
        return $this->player_url;
    }

    /**
     * Set watch_url
     *
     * @param string $watchUrl
     */
    public function setWatchUrl($watchUrl)
    {
        $this->watch_url = $watchUrl;
    }

    /**
     * Get watch_url
     *
     * @return string 
     */
    public function getWatchUrl()
    {
        return $this->watch_url;
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
}