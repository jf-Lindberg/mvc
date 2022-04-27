<?php

namespace App\Card;

use Exception;

class Hand
{
    /**
     * @var array<Card>
     */
    private array $handArray;
    private Deck $deck;


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
     * @return void
     */
    public function drawHand(int $cardAmount)
    {
        $this->handArray = $this->deck->draw($cardAmount);
    }

    /**
     * Gets current hand.
     *
     * @return array<Card>
     */
    public function getHand(): array
    {
        return $this->handArray;
    }
}
