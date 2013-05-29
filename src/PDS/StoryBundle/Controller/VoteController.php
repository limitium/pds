<?php

namespace PDS\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PDS\StoryBundle\Entity\Vote;
use PDS\StoryBundle\Form\VoteType;
use Symfony\Component\BrowserKit\Request;

/**
 * Vote controller.
 *
 * @Route("/vote")
 */
class VoteController extends Controller {

    /**
     * Creates a new Vote entity.
     *
     * @Route("/create", name="vote_create")
     * @Method("post")
     * @Template("PDSStoryBundle:Vote:show.html.twig")
     */
    public function createAction() {
        $entity = new Vote();
        $request = $this->getRequest();
        $form = $this->createForm(new VoteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $request->getSession()->set("voted_"+$entity->getStory()->getId(),1);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

        }

        return array(
            'vote' => $entity,
        );
    }
}
