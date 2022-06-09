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

    public function testGetCreateBook()
    {
        $client = static::createClient();
        $client->request('GET', '/library/create');

        $form_name = 'create_book';

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Lägg till bok');
        $this->assertSelectorExists('form');

        $this->assertSelectorTextSame('#'.$form_name.'_title', '');
        $this->assertSelectorTextSame('#'.$form_name.'_isbn', '');
        $this->assertSelectorTextSame('#'.$form_name.'_author', '');
        $this->assertSelectorTextSame('#'.$form_name.'_image', '');
        $this->assertSelectorTextSame('#'.$form_name.'_save', 'Spara i databas');
    }
}
