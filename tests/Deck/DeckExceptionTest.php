<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class DeckExceptionTest extends TestCase
{
    /**
     * @return void
     * @throws DeckAlreadyExistsException
     */
    public function testAddCardsToDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $this->expectException(DeckAlreadyExistsException::class);
        $deck->addCardsToDeck();
    }

    /**
     * @throws NotEnoughCardsException
     */
    public function testDraw()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $this->expectException(NotEnoughCardsException::class);
        $deck->draw(53);
    }

    /**
     * @throws DeckAlreadyExistsException
     */
    public function testReset()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $deckArray = $deck->get();

        $this->expectException(DeckAlreadyExistsException::class);
        $deck->reset(52, $deckArray);
    }
}
