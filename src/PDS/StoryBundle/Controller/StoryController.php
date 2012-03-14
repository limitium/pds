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

use Buzz\Browser;

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
     * @Route("/location/{id}", name="story_location")
     * @Template()
     */
    public function locationAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();


        $location = $em->getRepository('PDSStoryBundle:Country')->find($id);

        if (!$location) {
            throw $this->createNotFoundException('Unable to find Locatin entity.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->byLocation($location);

        return array('stories' => $stories, 'location' => $location
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/time/{id}", name="story_time")
     * @Template()
     */
    public function timeAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();


        $time = $em->getRepository('PDSStoryBundle:Time')->find($id);

        if (!$time) {
            throw $this->createNotFoundException('Unable to find Time entity.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->byTime($time);

        return array('stories' => $stories, 'time' => $time
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/topic/{id}", name="story_topic")
     * @Template()
     */
    public function topicAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();


        $topic = $em->getRepository('PDSStoryBundle:Tag')->find($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Tag.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->byTopic($topic);

        return array('stories' => $stories, 'topic' => $topic
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/teller/{id}", name="story_teller")
     * @Template()
     */
    public function tellerAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();


        $teller = $em->getRepository('PDSUserBundle:User')->find($id);

        if (!$teller) {
            throw $this->createNotFoundException('Unable to find Teller entity.');
        }

        $stories = $em->getRepository('PDSStoryBundle:Story')->byTeller($teller);

        return array('stories' => $stories, 'teller' => $teller
        );
    }

    /**
     * Lists all Story entities.
     *
     * @Route("/search", name="story_search")
     * @Template()
     */
    public function searchAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $q = $this->getRequest()->get("q");
        $stories = $em->getRepository('PDSStoryBundle:Story')->search($q);


        return array('stories' => $stories, 'q' => $q);
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
        $locations = $em->getRepository('PDSStoryBundle:Country')->findAll();
        $times = $em->getRepository('PDSStoryBundle:Time')->findAll();
        $topics = $em->getRepository('PDSStoryBundle:Tag')->findAll();
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
    public function showAction($id)
    {
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

        $related = $em->getRepository('PDSStoryBundle:Story')->related($story);
        $this->get('fpn_tag.tag_manager')->loadTagging($story);
        return array(
            'related' => $related,
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
    public function newAction()
    {
        $story = new Story();
        for ($i = 0; $i < 3; $i++) {
            $page = new Page();
            $story->addPage($page);
        }
        $form = $this->createForm(new StoryType(), $story);

        $devKey = "AI39si4W6QZ0x9lK4kBmLM0mxqMKYotCEcUZdz971RmCYHIbGaGmMSy9n0A7fqepT8i6cCnRpMzhJrUYT5wwpUc7yFhbiGDGYg";
        $browser = new Browser();

        $authenticationURL = 'https://www.google.com/accounts/ClientLogin';

        try {
            $client = \Zend_Gdata_ClientLogin::getHttpClient(
                $username = 'mystories.eu@gmail.com',
                $password = 'Xk@l456Kkd',
                $service = 'youtube',
                $client = null,
                $source = 'mystories.eu', // a short string identifying your application
                $loginToken = null,
                $loginCaptcha = null,
                $authenticationURL);
        } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
            echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
            echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
        } catch (Zend_Gdata_App_AuthException $ae) {
            echo 'Problem authenticating: ' . $ae->exception() . "\n";
        }
        https: //developers.google.com/youtube/2.0/developers_guide_php
        print_r($client);
        die;

// Note that this example creates an unversioned service object.
// You do not need to specify a version number to upload content
// since the upload behavior is the same for all API versions.
        $yt = new \Zend_Gdata_YouTube($client);

// create a new VideoEntry object
        $myVideoEntry = new \Zend_Gdata_YouTube_VideoEntry();

// create a new Zend_Gdata_App_MediaFileSource object
        $filesource = $yt->newMediaFileSource('c:\\Team-Gigglepin-4x4-Adventures-SS6[www.savevid.com].flv');
        $filesource->setContentType('video/quicktime');
// set slug header
        $filesource->setSlug('file.mov');

// add the filesource to the video entry
        $myVideoEntry->setMediaSource($filesource);

        $myVideoEntry->setVideoTitle('My Test Movie');
        $myVideoEntry->setVideoDescription('My Test Movie');
// The category must be a valid YouTube category!
        $myVideoEntry->setVideoCategory('Autos');

// Set keywords. Please note that this must be a comma-separated string
// and that individual keywords cannot contain whitespace
        $myVideoEntry->setVideoTags('cars, funny');

// set some developer tags -- this is optional
// (see Searching by Developer Tags for more details)
        $myVideoEntry->setVideoDeveloperTags(array('mydevtag', 'anotherdevtag'));

// set the video's location -- this is also optional
        $yt->registerPackage('Zend_Gdata_Geo');
        $yt->registerPackage('Zend_Gdata_Geo_Extension');
        $where = $yt->newGeoRssWhere();
        $position = $yt->newGmlPos('37.0 -122.0');
        $where->point = $yt->newGmlPoint($position);
        $myVideoEntry->setWhere($where);

// upload URI for the currently authenticated user
        $uploadUrl = 'http://uploads.gdata.youtube.com/feeds/api/users/default/uploads';

// try to upload the video, catching a Zend_Gdata_App_HttpException,
// if available, or just a regular Zend_Gdata_App_Exception otherwise
        try {
            $newEntry = $yt->insertEntry($myVideoEntry, $uploadUrl, 'Zend_Gdata_YouTube_VideoEntry');
        } catch (\Zend_Gdata_App_HttpException $httpException) {
            echo $httpException->getRawResponseBody();
        } catch (\Zend_Gdata_App_Exception $e) {
            echo $e->getMessage();
        }
//        $authenticationToken = $browser->post("https://www.google.com/accounts/ClientLogin",
//            array("Content-Type" => "application/x-www-form-urlencoded"),
//            "Email=mystories.eu&Passwd=Xk@l456Kkd&service=youtube&source=mystories.eu")->getContent();
//        list($crap, $authenticationToken) = explode("Auth=", $authenticationToken);
//        print_r($authenticationToken);
//

//               $browser= new Browser();;
//        $r = $browser->post("http://uploads.gdata.youtube.com/feeds/api/users/default/uploads",
//            array(
//                "youtube_username"=>"",
//                "Authorization" => "GoogleLogin auth=$authenticationToken",
//                "X-GData-Key" => "key=$devKey",
//                "GData-Version" => "2",
//                "Content-Length" => strlen($API_XML_Request),
//                "Content-Type" => "application/atom+xml; charset=UTF-8"
//            ), $API_XML_Request
//        );
//        echo '<pre>';
////        echo $browser->getC
////        echo $browser->getLastRequest()."\n";
//        print_r($r);


        die;
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
    public function createAction()
    {
        $story = new Story();
        $request = $this->getRequest();
        $form = $this->createForm(new StoryType(), $story);
        $form->bindRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            foreach ($story->getPages() as $page) {
                $page->setStory($story);
                $em->persist($page);
            }
            $story->setCreatedAt(new \DateTime("now"));
            $user = $this->container->get('security.context')->getToken()->getUser();
            $story->setUser($user);

            $this->updateTime($story, $em);

            $em->persist($story);
            $em->flush();

            $this->updateTopics($story);

            return $this->redirect($this->generateUrl('story_show', array('id' => $story->getId())));

        }

        return array(
            'source' => $story,
            'form' => $form->createView()
        );
    }

    private function updateTime($story, $em)
    {
        $years = floor($story->getDate()->format("Y") / 10) * 10;
        $time = $em->getRepository('PDSStoryBundle:Time')->findByName($years);
        if (sizeof($time) == 0) {
            $time = new Time();
            $time->setName($years);
            $em->persist($time);
        } else {
            $time = $time[0];
        }
        $story->setTime($time);
    }

    private function updateTopics(Story $story)
    {
        $tagManager = $this->get('fpn_tag.tag_manager');
        foreach (explode(",", $story->getTopics()) as $topic) {
            $topic = trim($topic);
            if ($topic) {
                $topic = $tagManager->loadOrCreateTag($topic);
                $tagManager->addTag($topic, $story);
            }
        }
        $tagManager->saveTagging($story);
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

        $story = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$story) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $this->get('fpn_tag.tag_manager')->loadTagging($story);
        $topics = array();
        foreach ($story->getTags() as $topic) {
            $topics[] = $topic->getName();
        }
        $story->setTopics(implode(", ", $topics));
        $editForm = $this->createForm(new StoryType(), $story);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'story' => $story,
            'form' => $editForm->createView(),
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

        $story = $em->getRepository('PDSStoryBundle:Story')->find($id);

        if (!$story) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $editForm = $this->createForm(new StoryType(), $story);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($story);
            foreach ($story->getPages() as $page) {
                $page->setStory($story);
                $em->persist($page);
            }
            $em->flush();

            $this->updateTopics($story);
            return $this->redirect($this->generateUrl('story_show', array('id' => $id)));
        }

        return array(
            'story' => $story,
            'form' => $editForm->createView(),
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
            ->getForm();
    }
}
