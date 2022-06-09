<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardJSONControllerTest extends WebTestCase
{
    public function testApiDeck()
    {
        $client = static::createClient();
        $client->request('GET', '/card/api/deck');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testApiShuffle()
    {
        $client = static::createClient();
        $client->request('GET', '/card/api/deck/shuffle');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testApiDrawSuccess()
    {
        $client = static::createClient();
        $client->request('GET', '/card/api/deck/draw');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        $exp = 'success';
        $res = $responseData['fetch'];
        $this->assertEquals($exp, $res);
    }

    public function testApiDrawFailure()
    {
        $client = static::createClient();
        $client->request('GET', '/card/api/deck/draw/53');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        $exp = 'failed';
        $res = $responseData['fetch'];
        $this->assertEquals($exp, $res);
    }

    public function testApiDealSuccess()
    {
        $client = static::createClient();
        $client->request('GET', '/card/api/deck/deal');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        $exp = 'success';
        $res = $responseData['fetch'];
        $this->assertEquals($exp, $res);
    }

    public function testApiDealFailure()
    {
        $client = static::createClient();
        $client->request('GET', '/card/api/deck/deal/2/27');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        $exp = 'failed';
        $res = $responseData['fetch'];
        $this->assertEquals($exp, $res);
    }
}
