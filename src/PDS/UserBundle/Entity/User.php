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
        return array($this->getRole()->getName());
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
        return $this->getUsername() == $user->getUsername();
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
    /**
     * @var text $biography
     */
    private $biography;

    /**
     * @var string $city
     */
    private $city;

    private $photo;

    /**
     * @var string $institution
     */
    private $institution;

    /**
     * @var datetime $birth
     */
    private $birth;

    /**
     * @var PDS\StoryBundle\Entity\Country
     */
    private $Country;


    /**
     * Set biography
     *
     * @param text $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * Get biography
     *
     * @return text
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set photo
     *
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set institution
     *
     * @param string $institution
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;
    }

    /**
     * Get institution
     *
     * @return string
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set birth
     *
     * @param datetime $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * Get birth
     *
     * @return datetime
     */
    public function getBirth()
    {
        return $this->birth;
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

    public function __sleep(){
        return array('username','id','first_name','last_name','email'); // add your own fields
    }

    /**
     * change to Image
     * @Assert\File(maxSize="2M")
     */
    public $file;

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->file->move($this->getUploadRootDir(), $this->id.'.jpg'/*.$this->file->guessExtension()*/);

        $this->photo =$this->id.'.jpg';

        unset($this->file);
    }

    private function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->id.'.jpg';
    }

    private function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    private function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'userpics';
    }
    /**
     * @var PDS\StoryBundle\Entity\Video
     */
    private $Videos;


    /**
     * Add Videos
     *
     * @param PDS\StoryBundle\Entity\Video $videos
     */
    public function addVideo(\PDS\StoryBundle\Entity\Video $videos)
    {
        $this->Videos[] = $videos;
    }

    /**
     * Get Videos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->Videos;
    }
    /**
     * @var PDS\UserBundle\Entity\Role
     */
    private $Role;


    /**
     * Set Role
     *
     * @param PDS\UserBundle\Entity\Role $role
     */
    public function setRole(\PDS\UserBundle\Entity\Role $role)
    {
        $this->Role = $role;
    }

    /**
     * Get Role
     *
     * @return PDS\UserBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->Role;
    }
    /**
     * @var boolean $teller_request
     */
    private $teller_request;


    /**
     * Set teller_request
     *
     * @param boolean $tellerRequest
     */
    public function setTellerRequest($tellerRequest)
    {
        $this->teller_request = $tellerRequest;
    }

    /**
     * Get teller_request
     *
     * @return boolean 
     */
    public function getTellerRequest()
    {
        return $this->teller_request;
    }
}