<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Game');
        $this->assertSelectorExists('a');
    }

    public function testGame()
    {
        $client = static::createClient();
        $client->request('GET', '/game/play');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Game');
    }

    public function testGameForm()
    {
        $client = static::createClient();
        $client->request('GET', '/game/form');

        $this->assertSelectorExists('title', 'redirecting');
    }
}
