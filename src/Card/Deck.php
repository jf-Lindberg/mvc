<?php

namespace App\Card;

class Deck implements DeckInterface
{
    private array $deck;

    public function __construct()
    {
        for ($i = 0; $i < 4; $i++) {
            for ($j = 2; $j < 15; $j++) {
                $card = new Card();
                $card->setCard($i, $j);
                $this->deck[] = $card;
            }
        }
    }

    /**
     * Returns an array with the "stringified" deck.
     *
     * @return array
     */
    public function getDeck(): array
    {
        $stringifiedDeck = [];
        foreach ($this->deck as $card) {
            $stringifiedDeck[] = $card->getCardAsArray();
        }
        return $stringifiedDeck;
    }

    /**
     * Shuffles all cards in the deck.
     *
     * @return void
     */
    public function shuffle(): void
    {
        shuffle($this->deck);
    }

    /** Draws a random card from the deck.
     *
     * @return Card
     */
    public function draw(): Card
    {
        $cardIndex = rand(0, (count($this->deck) - 1));
        $card = array_splice($this->deck, $cardIndex, 1);
        return $card[0];
    }
}
