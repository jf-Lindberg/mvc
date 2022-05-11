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
}
