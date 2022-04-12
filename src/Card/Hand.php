<?php

namespace App\Card;

use Exception;

class Hand
{
    private Deck $deck;
    private array $handArray;

    /**
     * Constructs a hand based on a deck.
     *
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
        $this->handArray = [];
    }

    /**
     * Draws a new hand.
     *
     * @throws Exception
     */
    public function drawHand(int $cardAmount)
    {
        $this->handArray = $this->deck->draw($cardAmount);
    }

    /**
     * Gets current hand.
     *
     * @return array
     */
    public function getHand(): array
    {
        return $this->handArray;
    }
}
