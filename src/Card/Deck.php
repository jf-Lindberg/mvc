<?php

namespace App\Card;

use Exception;

class Deck implements DeckInterface
{
    protected array $deck;
    private bool $isShuffled;

    public function __construct()
    {
        $this->createDeck();
        $this->isShuffled = false;
    }

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

    /**
     * Returns remainder of cards in the deck
     *
     * @return int length of deck
     */
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
        $this->isShuffled = true;
    }

    public function isShuffled(): bool
    {
        return $this->isShuffled;
    }

    /**
     * Draws $countOfCards random cards from the deck.
     *
     * @param int $countOfCards
     * @return array
     * @throws Exception
     */
    public function draw(int $countOfCards): array
    {
        $cardArray = [];
        if ($this->getLength() - $countOfCards < 0) {
            throw new Exception("Not enough cards");
        }
        for ($i = 0; $i < $countOfCards; $i++) {
            $card = array_splice($this->deck, ($this->getLength() - 1), 1);
            $cardArray[] = $card[0]->getCardAsArray();
        }
        return $cardArray;
    }
}
