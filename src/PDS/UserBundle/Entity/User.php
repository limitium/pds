<?php

namespace PDS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * PDS\UserBundle\Entity\User
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface {
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $username
     * @Assert\NotBlank()
     * @Assert\MinLength(
     *     limit=3,
     *     message="Your name must have at least {{ limit }} characters."
     * )
     */
    private $username;

    /**
     * @var string $password
     * @Assert\NotBlank()
     * @Assert\MinLength(
     *     limit=3,
     *     message="Your name must have at least {{ limit }} characters."
     * )
     */
    private $password;

    /**
     * @var smallint $email
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string $salt
     */
    private $salt;

    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * @var PDS\StoryBundle\Entity\Story
     */
    private $Stories;

    /**
     * @var PDS\StoryBundle\Entity\Vote
     */
    private $Votes;

    /**
     * @var PDS\StoryBundle\Entity\Comment
     */
    private $Comments;

    public function __construct() {
        $this->Stories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Votes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * Add Stories
     *
     * @param PDS\StoryBundle\Entity\Story $stories
     */
    public function addStory(\PDS\StoryBundle\Entity\Story $stories) {
        $this->Stories[] = $stories;
    }

    /**
     * Get Stories
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getStories() {
        return $this->Stories;
    }

    /**
     * Add Votes
     *
     * @param PDS\StoryBundle\Entity\Vote $votes
     */
    public function addVote(\PDS\StoryBundle\Entity\Vote $votes) {
        $this->Votes[] = $votes;
    }

    /**
     * Get Votes
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getVotes() {
        return $this->Votes;
    }

    /**
     * Add Comments
     *
     * @param PDS\StoryBundle\Entity\Comment $comments
     */
    public function addComment(\PDS\StoryBundle\Entity\Comment $comments) {
        $this->Comments[] = $comments;
    }

    /**
     * Get Comments
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getComments() {
        return $this->Comments;
    }

    /**
     * Returns the roles granted to the user.
     *
     * @return Role[] The user roles
     */
    function getRoles() {
        return array('master');
    }

    /**
     * Removes sensitive data from the user.
     *
     * @return void
     */
    function eraseCredentials() {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * The equality comparison should neither be done by referential equality
     * nor by comparing identities (i.e. getId() === getId()).
     *
     * However, you do not need to compare every attribute, but only those that
     * are relevant for assessing whether re-authentication is required.
     *
     * @param UserInterface $user
     *
     * @return Boolean
     */
    function equals(UserInterface $user) {
        return $this->username == $user->getUsername();
    }

    /**
     * Set email
     *
     * @param smallint $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return smallint 
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @var PDS\UserBundle\Entity\Role
     */
    private $Roles;


    /**
     * Add Roles
     *
     * @param PDS\UserBundle\Entity\Role $roles
     */
    public function addRole(\PDS\UserBundle\Entity\Role $roles)
    {
        $this->Roles[] = $roles;
    }
    /**
     * @var string $first_name
     */
    private $first_name;

    /**
     * @var string $last_name
     */
    private $last_name;


    /**
     * Set first_name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    public function __toString() {
        $name =  $this->getFirstName()." ".$this->getLastName();
        return $name!=" "?$name:$this->getUsername();
    }
}