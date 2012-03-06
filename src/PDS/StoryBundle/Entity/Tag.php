<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FPN\TagBundle\Entity\Tag as BaseTag;

class Tag extends BaseTag
{

    public function __toString()
    {
        return $this->getName();
    }
}