<?php

namespace PDS\StoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(1, $crawler->filter('html:contains("Gallery of stories")')->count(), "Click any word in title");

        $crawler = $client->click($crawler->selectLink('Location')->link());
        $this->assertEquals(1, $crawler->filter('.content-header:contains("Location")')->count(), "Location tags page");
        $crawler = $client->back();

        $crawler = $client->click($crawler->selectLink('Time')->link());
        $this->assertEquals(1, $crawler->filter('.content-header:contains("Time")')->count(), "Time tags page");
        $crawler = $client->back();

        $crawler = $client->click($crawler->selectLink('Topic')->link());
        $this->assertEquals(1, $crawler->filter('.content-header:contains("Topic")')->count(), "Topic tags page");
        $crawler = $client->back();

        $crawler = $client->click($crawler->selectLink('Story collector')->link());
        $this->assertEquals(1, $crawler->filter('.content-header:contains("Story teller")')->count(), "Story teller tags page");
        $crawler = $client->back();
    }

    public function testTag()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $boxes = $crawler->filter('.box-container');

        $this->assertEquals(6, $boxes->count(), "6 boxes at main page");

        $boxBody = $boxes->eq(0);
        $this->assertEquals(1, $boxBody->filter('a:contains("Location")')->count(), "1st box is location");
        $tagLinks = $boxBody->filter('.box-body a');
        $this->assertGreaterThan(0, $tagLinks->count(), "Location tag links");
        $this->assertEquals(1, $client->click($tagLinks->eq(0)->link())->filter('.content-header:contains("From ")')->count(), "Location from header");


        $boxBody = $boxes->eq(1);
        $this->assertEquals(1, $boxBody->filter('a:contains("Time")')->count(), "2nd box is time");
        $tagLinks = $boxBody->filter('.box-body a');
        $this->assertGreaterThan(0, $tagLinks->count(), "Time tag links");
        $this->assertEquals(1, $client->click($tagLinks->eq(0)->link())->filter('.content-header:contains("In ")')->count(), "Time In header");

        $boxBody = $boxes->eq(2);
        $this->assertEquals(1, $boxBody->filter('.box-header:contains("Top stories")')->count(), "3d box is to stories");
        $tagLinks = $boxBody->filter('.box-body a');
        $this->assertGreaterThan(0, $tagLinks->count(), "Show story links");


        $boxBody = $boxes->eq(3);
        $this->assertEquals(1, $boxBody->filter('a:contains("Topic")')->count(), "4d box is topic");
        $tagLinks = $boxBody->filter('.box-body a');
        $this->assertGreaterThan(0, $tagLinks->count(), "Topic tag links");
        $link = $tagLinks->eq(0)->link();
        $this->assertEquals(1, $client->click($link)->filter('.content-header:contains("' . $link->getNode()->textContent . '")')->count(), "Topic same as link");

        $boxBody = $boxes->eq(4);
        $this->assertEquals(1, $boxBody->filter('a:contains("Story collector")')->count(), "5th box is story collector");
        $tagLinks = $boxBody->filter('.box-body a');
        $this->assertGreaterThan(0, $tagLinks->count(), "Story teller links");
        $this->assertEquals(1, $client->click($tagLinks->eq(0)->link())->filter('.content-header:contains("By ")')->count(), "Story teller by header");

        $boxBody = $boxes->eq(5);
        $this->assertEquals(1, $boxBody->filter('.box-header:contains("Preview")')->count(), "6th box is preview");
    }
}