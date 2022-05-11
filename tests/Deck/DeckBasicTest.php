<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class DeckBasicTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreate()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->getLength();
        $exp = 52;
        $this->assertEquals($exp, $res);

        $res = $deck->get();
        $this->assertIsArray($res);

        $res = $deck->isShuffled();
        $this->assertFalse($res);
    }

    /**
     * @return void
     * @throws DeckAlreadyExistsException
     */
    public function testAddCardsToDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $deck->removeAllCards();
        $res = $deck->getLength();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $deck->addCardsToDeck();
        $res = $deck->getLength();
        $exp = 52;
        $this->assertEquals($exp, $res);
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->get();
        $this->assertIsArray($res);

        $res = $res[5];
        $this->assertInstanceOf("\App\Card\Card", $res);
    }

    /**
     * @return void
     */
    public function testJsonify()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->jsonify();
        $this->assertIsArray($res);
        $this->assertIsArray($res[12]);

        $res = $res[0];
        $exp = [
            "suit" => 'Spader',
            "rank" => '2',
            "value" => 2,
            "unicode" => '&#127138;'
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * @throws NotEnoughCardsException
     */
    public function testDrawNoArguments()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->draw();
        $this->assertIsArray($res);

        $len = count($res);
        $exp = 1;
        $this->assertEquals($exp, $len);

        $res = $res[0];
        $this->assertInstanceOf("\App\Card\Card", $res);

        $res = $deck->getLength();
        $exp = 51;
        $this->assertEquals($exp, $res);
    }

    /**
     * @throws NotEnoughCardsException
     */
    public function testDrawWithArgument()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->draw(12);
        $this->assertIsArray($res);

        $len = count($res);
        $exp = 12;
        $this->assertEquals($exp, $len);

        $res = $res[7];
        $this->assertInstanceOf("\App\Card\Card", $res);

        $res = $deck->getLength();
        $exp = 40;
        $this->assertEquals($exp, $res);
    }

    public function testShuffle()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $deck->shuffle();
        $res = $deck->isShuffled();
        $this->assertTrue($res);
    }

    /**
     * @throws NotEnoughCardsException
     * @throws DeckAlreadyExistsException
     */
    public function testReset()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $deck->draw(52);
        $res = $deck->get();
        $this->assertEmpty($res);

        $deck->reset();
        $res = $deck->get();
        $this->assertNotEmpty($res);

        $res = $deck->isShuffled();
        $this->assertTrue($res);
    }
}
