<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;

use PDS\StoryBundle\Entity\Story;
use PDS\StoryBundle\Entity\Time;
use PDS\StoryBundle\Entity\Country;
use PDS\StoryBundle\Entity\Tag;
use PDS\UserBundle\Entity\User;

class StoryRepository extends EntityRepository
{

    public function top($limit = 10)
    {
        return $this->getStories($this->generateTopQueryBuilder(), $limit);
    }

    private function getStories(QueryBuilder $queryBuilder, $limit = 10)
    {
        $query = $queryBuilder->getQuery();
        $query->setMaxResults($limit);
        $r = $query->getResult();
        $res = array();
        foreach ($r as $rr) {
            $res[] = $rr[0];
        }
        return $res;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function generateTopQueryBuilder()
    {
        return $this
            ->createQueryBuilder('s')
            ->select('s')
            ->addSelect("SUM(v.value)/COUNT(v.id) as rat")
            ->leftJoin("s.Votes", "v")
            ->groupBy("s.id")
            ->orderBy("rat", "desc");
    }


    public function byTime(Time $time)
    {
        return $this->getStories(
            $this->generateTopQueryBuilder()
                ->leftJoin("s.Time", "t")
                ->where("t.id = ?1")
                ->setParameter(1, $time->getId())
        );
    }

    public function byTeller(User $user)
    {
        return $this->getStories(
            $this->generateTopQueryBuilder()
                ->leftJoin("s.User", "u")
                ->where("u.id = ?1")
                ->setParameter(1, $user->getId())
        );
    }

    public function byLocation(Country $country)
    {
        return $this->getStories(
            $this->generateTopQueryBuilder()
                ->leftJoin("s.Country", "c")
                ->where("c.id = ?1")
                ->setParameter(1, $country->getId())
        );
    }

    public function byTopic(Tag $tag)
    {
        $storiesWithTag = $this->getEntityManager()
            ->getRepository('PDSStoryBundle:Tag')
            ->createQueryBuilder("t")
            ->select("tg.resourceId")
            ->leftJoin("t.tagging", "tg")
            ->where("tg.resourceType = 'story'")
            ->andWhere("t.id = ?1")
            ->setParameter(1, $tag->getId())
            ->getDQL();

        $queryBuilder = $this->generateTopQueryBuilder();
        return $this->getStories(
            $queryBuilder->where(
                $queryBuilder->expr()->in("s.id", $storiesWithTag)
            )
                ->setParameter(1, $tag->getId())
        );
    }


    public function related(Story $story)
    {
        return $this->top();
    }

    public function search($q)
    {
        return $this->top();
    }

}