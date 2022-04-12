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
        $ranks = ['Joker', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Knekt', 'Dam', 'Kung', 'Ess'];
        $suits = ['Hjärter', 'Spader', 'Ruter', 'Klöver'];
        for ($i = 0; $i < 4; $i++) {
            for ($j = 1; $j < 14; $j++) {
                $card = new Card($suits[$i], $ranks[$j]);
                $this->deck[] = $card;
            }
        }
    }

    /**
     * Returns an array of cards representing the deck.
     *
     * @return array
     */
    public function getDeck(): array
    {
        $deck = [];
        foreach ($this->deck as $card) {
            $deck[] = $card->getCard();
        }
        return $deck;
    }

    /**
     * Draws $countOfCards cards from the deck.
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
            $cardArray[] = $card[0]->getCard();
        }
        return $cardArray;
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
     * @return int length of deck
     */
    public function getLength(): int
    {
        return count($this->deck);
    }
}
