<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/library');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Bibliotek');
        $this->assertSelectorExists('a');
    }

    
}
