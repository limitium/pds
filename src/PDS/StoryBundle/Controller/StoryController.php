<?php

namespace PDS\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PDS\StoryBundle\Entity\Story;
use PDS\StoryBundle\Form\StoryType;

/**
 * Story controller.
 *
 * @Route("/story")
 */
class StoryController extends Controller
{
    /**
     * Lists all Story entities.
     *
     * @Route("/", name="story")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PDSStoryBundle:Story')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Story entity.
     *
     * @Route("/{id}/show", name="story_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Story entity.
     *
     * @Route("/new", name="story_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Story();
        $form   = $this->createForm(new StoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Story entity.
     *
     * @Route("/create", name="story_create")
     * @Method("post")
     * @Template("PDSStoryBundle:Story:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Story();
        $request = $this->getRequest();
        $form    = $this->createForm(new StoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setCreatedAt(new \DateTime("now"));
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('story_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Story entity.
     *
     * @Route("/{id}/edit", name="story_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $editForm = $this->createForm(new StoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $editForm   = $this->createForm(new StoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('story_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Story entity.
     *
     * @Route("/{id}/delete", name="story_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
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

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
