<?php

namespace PDS\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use  Doctrine\ORM\EntityRepositor;

use PDS\StoryBundle\Entity\Story;
use PDS\StoryBundle\Form\StoryType;
use PDS\StoryBundle\Entity\Comment;
use PDS\StoryBundle\Form\CommentType;
use PDS\StoryBundle\Entity\Vote;
use PDS\StoryBundle\Form\VoteType;

use PDS\StoryBundle\Entity\Time;
use PDS\StoryBundle\Entity\Page;

use PDS\StoryBundle\Youtube\YoutubeFile;

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

        $locations = $this->getWeight($em->getRepository('PDSStoryBundle:Country'));
        $times = $this->getWeight($em->getRepository('PDSStoryBundle:Time'));
        $tellers = $this->getWeight($em->getRepository('PDSUserBundle:User'));

        $topics = $this->calculateWeight($em
            ->getRepository('PDSStoryBundle:Tag')
            ->createQueryBuilder("t")
            ->select("t")
            ->addSelect("COUNT(t.id) as weight")
            ->leftJoin("t.tagging", "tg")
            ->where("tg.resourceType = 'story'")
            ->groupBy("t.id")
            ->getQuery()
            ->getResult());


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
        for ($i = 0; $i < 2; $i++) {
            $page = new Page();
            $story->addPage($page);
        }
        $form = $this->createForm(new StoryType(), $story);

        $formView = $form->createView();
        $formView['meta']->setAttribute('placeholder', 'Meta information about story, keywords, dates etc.');
        $formView['Pages'][0]['body']->setAttribute('placeholder', 'Write here summary of the sotry. This page will show your summary and some information about your story.');
        $formView['Pages'][1]['body']->setAttribute('placeholder', 'Add your story here. If you want to have more pages, just click + Page button below this box.');
        return array(
            'entity' => $story,
            'form' => $formView,
            'formUpload' => $this->createUploadForm()->createView()
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

    /**
     * @return \Symfony\Component\Form\Form
     */
    private function createUploadForm()
    {
        return $this->createFormBuilder()
            ->add('video', 'file', array('required' => true))
            ->add('title', 'text', array('required' => true))
            ->getForm();
    }

    /**
     * Uploads video
     *
     * @Route("/upload/video", name="story_upload_video")
     * @Method("post")
     * @Template()
     */
    public function uploadAction()
    {
        $form = $this->createUploadForm();
        $form->bindRequest($this->getRequest());
        if ($form->isValid()) {
            $data = $form->getData();
            $video = $data['video'];
            if ($video->isValid()) {
                $yf = new YoutubeFile($data['title'], $video->move(sys_get_temp_dir(), $video->getClientOriginalName())->getPathname());
                $videoEntry = $yf->upload();
                $thumbnails = $videoEntry->getVideoThumbnails();
                return array(
                    'ok' => true,
                    'video' => array(
                        'thumbnail' => $thumbnails[2]['url'],
                        'url' => $videoEntry->getVideoWatchPageUrl(),
                        'player' => $videoEntry->getFlashPlayerUrl()
                    )
                );
            }
        }
        return array(
            'ok' => false,
        );
    }

}