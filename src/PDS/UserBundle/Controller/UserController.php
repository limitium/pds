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
/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Login form
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * Login form
     * @Template()
     */
    public function signupAction()
    {
        $user = new User();
        $form   = $this->createForm(new UserType(), $user);

        return array(
            'entity' => $user,
            'form'   => $form->createView()
        );
    }

    /**
     * Login form
     * @Route("/new", name="usernew")
     * @Method("post")
     * @Template("PDSUserBundle:User:signup.html.twig")
     */
    public function usernewAction()
    {
        $user  = new User();
        $request = $this->getRequest();
        $form    = $this->createForm(new UserType(), $user);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $user->setSalt("123");
            $user->setCreatedAt(new \DateTime("now"));

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();

            $upToken = new UsernamePasswordToken($user->getUsername(),$user->getPassword(),"main",array());
            $this->get('security.context')->setToken($upToken);
            return $this->redirect($this->generateUrl('login'));

        }

        return array(
            'user' => $user,
            'form'   => $form->createView()
        );
    }
}
