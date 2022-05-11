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

        $res = $deck->getDeck();
        $this->assertIsArray($res);

        $res = $deck->isShuffled();
        $this->assertFalse($res);
    }

    /**
     * @return void
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
}
