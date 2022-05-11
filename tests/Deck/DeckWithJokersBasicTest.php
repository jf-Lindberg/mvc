<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class DeckWithJokersBasicTest extends TestCase
{

    /**
     * @return void
     * @throws DeckAlreadyExistsException
     */
    public function testAddCardsToDeck()
    {
        $deck = new Deck2();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $deck->removeAllCards();
        $res = $deck->getLength();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $deck->addCardsToDeck();
        $res = $deck->getLength();
        $exp = 54;
        $this->assertEquals($exp, $res);
    }
}
