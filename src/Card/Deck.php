<?php

namespace App\Card;

use Exception;

class Deck implements DeckInterface
{
    /**
     * @var array<CardInterface> $deck
     */
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
     * @return array<CardInterface>
     */
    public function getDeck(): array
    {
        return $this->deck;
    }

    /** Returns array of arrays consisting of card values
     *
     * @return array<array<string, string>>
     */
    public function getJsonDeck(): array
    {
        $res = [];
        foreach ($this->deck as $card) {
            $res[] = $card->getJsonCard();
        }
        return $res;
    }

    /**
     * @param int $countOfCards
     * @return array<int, CardInterface>
     * @throws Exception
     */
    public function draw(int $countOfCards): array
    {
        $drawnCards = [];
        if ($this->getLength() - $countOfCards < 0) {
            throw new Exception("Not enough cards");
        }
        for ($i = 0; $i < $countOfCards; $i++) {
            $card = array_splice($this->deck, ($this->getLength() - 1), 1);
            $drawnCards[] = $card[0];
        }
        return $drawnCards;
    }

    /**
     * Shuffles all cards in the deck.
     *
     * @return void
     */
    public function shuffle(): void
    {
        shuffle( $this->deck);
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
     * @return int
     */
    public function getLength(): int
    {
        return count($this->deck);
    }
}
