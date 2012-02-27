<?php

namespace PDS\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PDS\StoryBundle\Entity\Story;
use PDS\StoryBundle\Form\StoryType;
use PDS\StoryBundle\Entity\Comment;
use PDS\StoryBundle\Form\CommentType;
use PDS\StoryBundle\Entity\Vote;
use PDS\StoryBundle\Form\VoteType;

use PDS\StoryBundle\Entity\Time;
use PDS\StoryBundle\Entity\Page;

/**
 * Story controller.
 *
 * @Route("/story")
 */
class StoryController extends Controller {
    /**
     * Lists all Story entities.
     *
     * @Route("/location/{id}", name="story_location")
     * @Template()
     */
    public function locationAction($id) {
        $em = $this->getDoctrine()->getEntityManager();


        $location = $em->getRepository('PDSStoryBundle:Country')->find($id);

        if (!$location) {
            throw $this->createNotFoundException('Unable to find Locatin entity.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->findAll();

        return array('stories' => $stories,'location'=>$location
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/time/{id}", name="story_time")
     * @Template()
     */
    public function timeAction($id) {
        $em = $this->getDoctrine()->getEntityManager();


        $time = $em->getRepository('PDSStoryBundle:Time')->find($id);

        if (!$time) {
            throw $this->createNotFoundException('Unable to find Time entity.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->findAll();

        return array('stories' => $stories,'time'=>$time
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/teller/{id}", name="story_teller")
     * @Template()
     */
    public function tellerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();


        $teller = $em->getRepository('PDSUserBundle:User')->find($id);

        if (!$teller) {
            throw $this->createNotFoundException('Unable to find Teller entity.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->findAll();

        return array('stories' => $stories,'teller'=>$teller
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/", name="story")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $stories = $em->getRepository('PDSStoryBundle:Story')->findAll();
        $locations = $em->getRepository('PDSStoryBundle:Country')->findAll();
        $times = $em->getRepository('PDSStoryBundle:Time')->findAll();
        $topics = $em->getRepository('PDSStoryBundle:Topic')->findAll();
        $tellers = $em->getRepository('PDSUserBundle:User')->findAll();


        return array('stories' => $stories,
            'locations' => $locations,
            'times' => $times,
            'topics' => $topics,
            'tellers' => $tellers);
    }

    /**
     * Finds and displays a Story entity.
     *
     * @Route("/{id}/show", name="story_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();


        $story = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$story) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $comment = new Comment();
        $comment->setStory($story);
        $formComment = $this->createForm(new CommentType(), $comment);

        $vote = new Vote();
        $vote->setStory($story);
        $formVote = $this->createForm(new VoteType(), $vote);

        return array(
            'story' => $story,
            'form_comment' => $formComment->createView(),
            'form_vote' => $formVote->createView(),
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Story entity.
     *
     * @Route("/new", name="story_new")
     * @Template()
     */
    public function newAction() {
        $story = new Story();
        for($i=0;$i<3;$i++){
            $page = new Page();
            $story->addPage($page);
        }
        $form = $this->createForm(new StoryType(), $story);

        return array(
            'entity' => $story,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Story entity.
     *
     * @Route("/create", name="story_create")
     * @Method("post")
     * @Template("PDSStoryBundle:Story:new.html.twig")
     */
    public function createAction() {
        $entity = new Story();
        $request = $this->getRequest();
        $form = $this->createForm(new StoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setCreatedAt(new \DateTime("now"));
            $user = $this->container->get('security.context')->getToken()->getUser();
            $entity->setUser($user);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('story_show', array('id' => $entity->getId())));

        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
 * Displays a form to edit an existing Story entity.
 *
 * @Route("/{id}/edit", name="story_edit")
 * @Template()
 */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $editForm = $this->createForm(new StoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Story entity.
     *
     * @Route("/{id}/update", name="story_update")
     * @Method("post")
     * @Template("PDSStoryBundle:Story:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $editForm = $this->createForm(new StoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('story_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Story entity.
     *
     * @Route("/{id}/delete", name="story_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PDSStoryBundle:Story')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Story entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('story'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
