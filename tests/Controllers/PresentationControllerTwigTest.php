<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PresentationControllerTwigTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Presentation');
    }

    public function testAbout()
    {
        $client = static::createClient();
        $client->request('GET', '/about');

        $this->assertResponseIsSuccessful();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Kursbeskrivning');
    }
}
