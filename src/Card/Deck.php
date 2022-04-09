<?php

namespace App\Card;

class Deck implements DeckInterface
{
    private array $deck;

    public function __construct()
    {
        $this->createDeck();
    }
    // USE TRAITS TO IMPLEMENT BELOW WHEN ADDING DECK2
    /**
     * Creates a deck.
     *
     * @return void
     */
    public function createDeck(): void
    {
        $this->deck = [];
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

    public function getLength(): int
    {
        return count($this->deck);
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

    /**
     * Draws a random card from the deck.
     *
     * @param int $countOfCards
     * @return array
     */
    public function draw(int $countOfCards): array
    {
        $cardArray = [];
        for ($i = 0; $i < $countOfCards; $i++) {
            $card = array_splice($this->deck, ($this->getLength() - 1), 1);
            $cardArray[] = $card[0]->getCardAsArray();
        }
        return $cardArray;
    }
}
