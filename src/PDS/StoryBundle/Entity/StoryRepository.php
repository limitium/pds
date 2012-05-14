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

    public function publishRequest()
    {
        return $this
            ->createQueryBuilder('s')
            ->select('s')
            ->leftJoin('s.Status', 'st')
            ->where('st.id = 3')
            ->getQuery()
            ->getResult();
    }

    public function top($limit = 10)
    {
        return $this->getStories($this->generateTopQueryBuilder(), $limit);
    }

    public function byTime(Time $time)
    {
        return $this->getFilteredBy($time);
    }

    public function byTeller(User $user)
    {
        return $this->getFilteredBy($user);
    }

    public function byLocation(Country $country)
    {
        return $this->getFilteredBy($country);
    }

    public function byTopic(Tag $tag)
    {
        $publishedStories = $this->getEntityManager()
            ->getRepository('PDSStoryBundle:Story')
            ->createQueryBuilder("str")
            ->select("str.id")
            ->leftJoin("str.Status", "sta")
            ->where("sta.id= 2")
            ->getDQL();

        $queryBuilder = $this->getEntityManager()
            ->getRepository('PDSStoryBundle:Tag')
            ->createQueryBuilder("t");

        $storiesWithTag = $queryBuilder
            ->select("tg.resourceId")
            ->leftJoin("t.tagging", "tg")
            ->where("tg.resourceType = 'story'")
            ->andWhere(
                $queryBuilder->expr()->in("tg.resourceId", $publishedStories)
            )
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
        $queryBuilder = $this->generateTopQueryBuilder();
        return $this->getStories(
            $queryBuilder
                ->where($queryBuilder->expr()->like("s.title", "'%$q%'"))
        );
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
            ->leftJoin("s.Status", "st")
            ->where("st.id = 2")
            ->groupBy("s.id")
            ->orderBy("rat", "desc");
    }


    private function getFilteredBy($relatedEntity)
    {
        $class = explode("\\", get_class($relatedEntity));
        return $this->getStories(
            $this->generateTopQueryBuilder()
                ->leftJoin("s." . end($class), "r")
                ->where("r.id = ?1")
                ->setParameter(1, $relatedEntity->getId())
        );
    }

}