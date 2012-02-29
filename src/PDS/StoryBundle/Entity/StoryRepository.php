<?php

namespace PDS\StoryBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class StoryRepository extends EntityRepository {

    public function top($limit = 10){
        $q = $this
            ->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery();
        try {
            ////             The Query::getSingleResult() method throws an exception
            ////             if there is no record matching the criteria.
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(sprintf('Unable to find an active admin AcmeUserBundle:User object identified by "%s".', $username), null, 0, $e);
        }

        return $user;
    }

}