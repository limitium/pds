<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

use PDS\StoryBundle\Entity\Story;

class StoryRepository extends EntityRepository
{

    public function top($limit = 10)
    {
        $q = $this
            ->createQueryBuilder('s')
            ->select('s')
            ->addSelect("SUM(v.value)/COUNT(v.id) as rat")
            ->leftJoin("s.Votes", "v")
            ->groupBy("s.id")
            ->orderBy("rat", "desc")
            ->getQuery();

        $q->setMaxResults($limit);
        $r = $q->getResult();
        $res = array();
        foreach ($r as $rr) {
            $res[] = $rr[0];
        }
        return $res;
    }

    public function related(Story $story)
    {

        return $this->top();
    }

}