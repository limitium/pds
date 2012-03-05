<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \FPN\TagBundle\Entity\Tagging as BaseTagging;

class Tagging extends BaseTagging
{

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var PDS\StoryBundle\Entity\Tag
     */
    protected $Tag;


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
     * Get Tag
     *
     * @return PDS\StoryBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->Tag;
    }
}