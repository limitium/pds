<?php

namespace PDS\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PDS\StoryBundle\Entity\Comment;
use PDS\StoryBundle\Form\CommentType;

/**
 * Comment controller.
 *
 * @Route("/story")
 */
class TagController extends Controller
{
    /**
     * Lists all Story entities.
     *
     * @Route("/tag/location", name="story_tag_location")
     * @Template()
     */
    public function tagLocationAction()
    {
        $em = $this->getDoctrine()->getEntityManager();


        $locations = $this->getWeight($em->getRepository('PDSStoryBundle:Country'));

        shuffle($locations);

        return array(
            'locations' => $locations
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/tag/time", name="story_tag_time")
     * @Template()
     */
    public function tagTimeAction()
    {
        $em = $this->getDoctrine()->getEntityManager();


        $times = $this->getWeight($em->getRepository('PDSStoryBundle:Time'));

        shuffle($times);

        return array(
            'times' => $times
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/tag/topic", name="story_tag_topic")
     * @Template()
     */
    public function tagTopicAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $topics = $this->getTopics($em);

        shuffle($topics);

        return array(
            'topics' => $topics
        );
    }

    private function getTopics($em)
    {
        $publishedStories = $em
            ->getRepository('PDSStoryBundle:Story')
            ->createQueryBuilder("s")
            ->select("s.id")
            ->leftJoin("s.Status", "st")
            ->where("st.id= 2")
            ->getDQL();

        $queryBuilder = $em
            ->getRepository('PDSStoryBundle:Tag')
            ->createQueryBuilder("t");

        return $this->calculateWeight($queryBuilder
            ->select("t")
            ->addSelect("COUNT(t.id) as weight")
            ->leftJoin("t.tagging", "tg")
            ->where("tg.resourceType = 'story'")
            ->andWhere(
                $queryBuilder->expr()->in("tg.resourceId", $publishedStories)
            )
            ->groupBy("t.id")
            ->getQuery()
            ->getResult());
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/tag/teller", name="story_tag_teller")
     * @Template()
     */
    public function tagTellerAction()
    {
        $em = $this->getDoctrine()->getEntityManager();


        $tellers = $this->getWeight($em->getRepository('PDSUserBundle:User'));

        shuffle($tellers);

        return array(
            'tellers' => $tellers
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/", name="story")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $stories = $em->getRepository('PDSStoryBundle:Story')->top(7);

        $locations = $this->getWeight($em->getRepository('PDSStoryBundle:Country'));
        $times = $this->getWeight($em->getRepository('PDSStoryBundle:Time'));
        $tellers = $this->getWeight($em->getRepository('PDSUserBundle:User'));
        $topics = $this->getTopics($em);


        $images = array();
        foreach ($stories as $story) {
            foreach ($story->getPages() as $page) {
                preg_match_all("/(<img .+?>)/i", $page->getBody(), $matches);
                foreach ($matches[1] as $img) {
                    $images[] = array('img' => $img,
                        'story' => $story,
                        'page' => $page);
                }
            }
        }

        shuffle($images);
        shuffle($locations);
        shuffle($times);
        shuffle($topics);
        shuffle($tellers);

        return array('stories' => $stories,
            'locations' => $locations,
            'times' => $times,
            'topics' => $topics,
            'tellers' => $tellers,
            'images' => $images);
    }

    private function getWeight(\Doctrine\ORM\EntityRepository $repo)
    {
        return $this->calculateWeight($repo
            ->createQueryBuilder("c")
            ->select("c")
            ->addSelect("COUNT(c.id) as weight")
            ->leftJoin("c.Stories", "s")
            ->leftJoin("s.Status", "st")
            ->where("st.id = 2")
            ->groupBy("c.id")
            ->getQuery()
            ->getResult());

    }

    private function calculateWeight($entities)
    {
        $max = 0;
        $min = PHP_INT_MAX;
        foreach ($entities as $r) {
            $min = min($r['weight'], $min);
            $max = max($r['weight'], $max);
        }
        $result = array();
        foreach ($entities as $r) {
            $r[0]->weight = round($r["weight"] * 12 / $max);
            $result[] = $r[0];
        }
        return $result;
    }


}
