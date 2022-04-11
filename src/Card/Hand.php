<?php

namespace App\Card;

use Exception;

class Hand
{
    private Deck $deck;
    private array $handArray;

    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
        $this->handArray = [];
    }

    /**
     * @throws Exception
     */
    public function drawHand(int $cardAmount)
    {
        $this->handArray = $this->deck->draw($cardAmount);
    }

    public function getHand(): array
    {
        return $this->handArray;
    }
}
