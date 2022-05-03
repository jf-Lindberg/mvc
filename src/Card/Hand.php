<?php

namespace App\Card;

use Exception;

class Hand implements HandInterface
{
    /**
     * @var array<Card>
     */
    private array $handArray;
    private DeckInterface $deck;


    /**
     * Constructs a hand based on a deck.
     *
     * @param DeckInterface $deck
     */
    public function __construct(DeckInterface $deck)
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

    public function drawMoreCards(int $cardAmount)
    {
        $drawn = $this->deck->draw($cardAmount);
        foreach ($drawn as $card)
        {
            $this->handArray[] = $card;
        }
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
