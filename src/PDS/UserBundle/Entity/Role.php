<?php

namespace PDS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PDS\UserBundle\Entity\Role
 */
class Role
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
     * @var PDS\UserBundle\Entity\User
     */
    private $Users;

    public function __construct()
    {
        $this->Users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add Users
     *
     * @param PDS\UserBundle\Entity\User $users
     */
    public function addUser(\PDS\UserBundle\Entity\User $users)
    {
        $this->Users[] = $users;
    }

    /**
     * Get Users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->Users;
    }
}