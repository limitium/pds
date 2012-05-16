<?php

namespace PDS\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use  Doctrine\ORM\EntityRepositor;

use PDS\StoryBundle\Entity\Story;
use PDS\StoryBundle\Form\StoryType;
use PDS\StoryBundle\Entity\Comment;
use PDS\StoryBundle\Form\CommentType;
use PDS\StoryBundle\Entity\Vote;
use PDS\StoryBundle\Form\VoteType;

use PDS\StoryBundle\Entity\Time;
use PDS\StoryBundle\Entity\Page;
use PDS\StoryBundle\Entity\Status;

use PDS\StoryBundle\Youtube\YoutubeFile;

use Buzz\Browser;

/**
 * Story controller.
 *
 * @Route("/admin/story")
 */
class AdminController extends Controller
{

    /**
     * Lists all request Story entities.
     *
     * @Route("/publish/request", name="story_publish_requests")
     * @Template()
     */
    public function publishlistAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $stories = $em->getRepository('PDSStoryBundle:Story')->publishRequest();


        return array('stories' => $stories);
    }

    /**
     *  Moderate publish request for story.
     *
     * @Route("/story/{id}/{statusId}", name="story_moderate")
     * @Method("post")
     */
    public function moderateAction($id, $statusId)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $story = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$story) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $status = $em->getRepository('PDSStoryBundle:Status')->find($statusId);

        if (!$status) {
            throw $this->createNotFoundException('Unable to find status entity.');
        }

        $story->setStatus($status);
        $em->flush();

        return new Response("ok");

    }
}