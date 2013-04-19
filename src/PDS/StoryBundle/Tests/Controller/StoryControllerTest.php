<?php

namespace PDS\StoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StoryControllerTest extends WebTestCase
{
    public function testShowStory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $link = $crawler->filter('.box-container')->eq(2)->filter('.box-body a')->eq(0)->link();

        $crawler = $client->click($link);
        $this->assertEquals(1, $crawler->filter('.content-header:contains("' . $link->getNode()->textContent . '")')->count(), "Story name same as link title");
        $this->assertEquals(1, $crawler->filter('#comments')->count(), "Has comments block");
        $this->assertEquals(1, $crawler->filter('.projector')->count(), "Has story projector");
        $this->assertEquals(0, $crawler->filter('#form_comment')->count(), "Hasn't comments form");
    }

    public function testCreateStory()
    {
        $client = static::createClient();

        $crawler = $this->signIn($client);
        $title = 'Test story title';
        $crawler = $this->createStory($client, $crawler, $title);

        $this->searchStory($client, $title);

        $crawler = $this->editStory($client, $crawler);
        $crawler = $this->writeComment($client, $crawler);
        $crawler = $this->vote($client, $crawler);
        $crawler = $this->deleteStory($client, $crawler);
    }

    private function signIn($client)
    {
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['username'] = 'qwe';
        $form['password'] = 'qwe';
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertEquals(1, $crawler->filter('.nav a:contains("Sign out")')->count(), "Logout url");
        return $crawler;
    }

    private function createStory($client, $crawler, $title)
    {
        $crawler = $client->click($crawler->selectLink('Add story')->link());
        $this->assertEquals(1, $crawler->filter('.content-header:contains("Create a new story")')->count(), "Create a new story title");

        $form = $crawler->selectButton('Create')->form();

        $form['story[title]'] = $title;
        $form['story[Country]']->select('1');
        $form['story[meta_place]'] = 'test_meta_place1';
        $form['story[Time]']->select('1');
        $form['story[meta_time]'] = 'test_meta_time1';
        $form['story[Topics]'] = 'test_topic1,test_topic2';
        $form['story[meta]'] = 'test_meta';
        $form['story[meta_storyteller]'] = 'test_story_teller_meta';
        $form['story[Pages][0][body]'] = 'Cover page text';
        $form['story[Pages][1][body]'] = 'Page 1 text';

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('.content-header:contains("' . $form['story[title]']->getValue() . '")')->count(), "New story created");
        return $crawler;
    }

    private function writeComment($client, $crawler)
    {
        $this->assertEquals(1, $crawler->filter('#form_comment')->count(), "Has a comment form");
        $form = $crawler->selectButton('Add')->form();
        $form['comment[message]'] = 'Test comment msg';
        $this->assertEquals(1, $client->submit($form)->filter('div.span7:contains("' . $form['comment[message]']->getValue() . '")')->count(), "Comment created");
        return $crawler;
    }

    private function vote($client, $crawler)
    {
        $formNode = $crawler->filter('#form_vote');
        $this->assertEquals(1, $formNode->count(), "Has a vote form");

        $client->request(
            'POST',
            $formNode->attr('action'),
            array('vote' =>
            array('_token' => $crawler->filter('#vote__token')->attr('value'),
                'value' => 5,
                'Story' => $crawler->filter('#vote_Story')->attr('value'))
            )
        );

        $this->assertEquals("5.00", $client->getResponse()->getContent(), "Rating is five");
        return $crawler;
    }

    private function editStory($client, $crawler)
    {
        $crawler = $client->click($crawler->selectLink('Edit')->link());
        $this->assertEquals(1, $crawler->filter('.content-header:contains("Edit a story")')->count(), "Edit story title");

        $form = $crawler->selectButton('Update')->form();
        $form['story[title]'] = 'Test story title edited';

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('.content-header:contains("' . $form['story[title]']->getValue() . '")')->count(), "Story edited");
        return $crawler;
    }

    private function deleteStory($client, $crawler)
    {
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('html:contains("Gallery of stories")')->count(), "Click any word in title on main page");
    }

    private function searchStory($client, $title)
    {
        $crawler = $client->request(
            'POST',
            '/story/search',
            array('q' => 'test')
        );

        $this->assertGreaterThan(0, $crawler->filter('.short-list a:contains("' . $title . '")')->count(), "Test story found");
    }


}