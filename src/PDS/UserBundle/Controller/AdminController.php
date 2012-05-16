<?php

namespace PDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use PDS\UserBundle\Entity\User;
use PDS\UserBundle\Form\UserType;
use PDS\UserBundle\Form\RegisterType;

/**
 * Story controller.
 *
 * @Route("/admin/user")
 */
class AdminController extends Controller
{

    /**
     * Lists all request Story entities.
     *
     * @Route("/teller/request", name="storyteller_requests")
     * @Template()
     */
    public function requestlistAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $users = $em->getRepository('PDSUserBundle:User')->findBy(array('teller_request'=>1));


        return array('users' => $users);
    }

    /**
     *  Moderate publish request for story.
     *
     * @Route("/user/{id}/{promote}", name="user_moderate")
     * @Method("post")
     */
    public function moderateAction($id, $promote)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository('PDSUserBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $user->setTellerRequest(null);
        if ($promote) {
            $user->setRole($em->getRepository('PDSUserBundle:Role')->find(3));
        }

        $em->flush();

        return new Response("ok");

    }
}