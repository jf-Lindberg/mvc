<?php

namespace App\Card;

use Exception;

class newDeck
{
    private array $deck;
    private int $size;
    private int $usedCards;
    private bool $isShuffled;

    public function __construct()
    {
        $this->size = 0;
        $this->usedCards = 0;
        $this->isShuffled = false;
        $this->deck = [];
        $this->initializeDeck();
    }

    public function initializeDeck()
    {
        for ($suit = 0; $suit <= 3; $suit++) {
            for ($rank = 2; $rank <= 14; $rank++) {
                $this->deck[$this->size] = new newCard($suit, $rank);
                $this->size++;
            }
        }
    }

    public function shuffle()
    {
        shuffle($this->deck);
        $this->isShuffled = true;
    }

    /**
     * @throws Exception
     */
    public function deal()
    {
        if ($this->size === $this->usedCards) {
            throw new Exception;
        }
        $this->usedCards++;
        return $this->deck[$this->usedCards - 1];
    }

    /**
     * Returns whether deck is shuffled or not.
     *
     * @return bool
     */
    public function isShuffled(): bool
    {
        return $this->isShuffled;
    }

    /**
     * Returns remainder of cards in the deck.
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->size - $this->usedCards;
    }

    public function getDeck(): array
    {
        return $this->deck;
    }
}
