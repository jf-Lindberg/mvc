<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardGameControllerTest extends WebTestCase
{
    public function testCard()
    {
        $client = static::createClient();
        $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Card');
        $this->assertSelectorExists('a');
    }

    public function testDeck()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Deck');
        $this->assertSelectorExists('.card');
    }

    public function testDeck2()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck2');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Deck');
        $this->assertSelectorExists('.card');
    }

    public function testShuffle()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Shuffle');
        $this->assertSelectorExists('.card');
    }

    public function testDraw()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/draw');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Draw');
        $this->assertSelectorExists('.card');
    }

    public function testDrawTooMany()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/draw/53');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Draw');
        $this->assertSelectorExists('.flash-info');
    }

    public function testDeal()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/deal');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Deal');
        $this->assertSelectorTextSame('p', 'Spelare 1');
        $this->assertSelectorExists('.card');
    }

    public function testDealTooManyCards()
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/deal/2/27');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Deal');
        $this->assertSelectorExists('.flash-info');
    }
}
