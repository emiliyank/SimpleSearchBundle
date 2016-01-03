<?php
// src/Emo/SimpleSearchBundle/Tests/Controller/SimpleSearchControllerTest.php

namespace Emo\SimpleSearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SimpleSearchControllerTest extends WebTestCase
{
	public function testSearchFormRender()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/emo_simple_search_bundle/search');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Search Content:*', $client->getResponse()->getContent());
        $this->assertContains('File Type:', $client->getResponse()->getContent());
        $this->assertContains('Search Path:', $client->getResponse()->getContent());
        $this->assertContains('Search for File', $client->getResponse()->getContent());

		$this->assertEquals(2, $crawler->filter('input[type=text]')->count());
		$this->assertEquals(1, $crawler->filter('select')->count());
		$this->assertGreaterThan(0, $crawler->filter('option')->count());
    }
    
    //TODO - submitForm with no results

    //TODO - submitForm with some result x 2
}