<?php

namespace App\Card;

use Exception;

class Deck implements DeckInterface
{
    /**
     * @var int
     */
    protected int $size;

    /**
     * @var array<Card>
     */
    protected array $deck;

    /**
     * @var bool
     */
    private bool $isShuffled;

    /** Constructor for the deck class.
     * The class contains an array of card objects representing
     * a deck of cards. It is possible to shuffle, draw cards
     * and get the entire deck.
     *
     */
    public function __construct()
    {
        $this->size = 0;
        $this->deck = [];
        $this->isShuffled = false;
        $this->createDeck();
    }

    /** Adds card objects to the array representing the deck.
     *
     * @return void
     */
    public function createDeck(): void
    {
        for ($suit = 0; $suit <= 3; $suit++) {
            for ($rank = 2; $rank <= 14; $rank++) {
                $this->deck[$this->size] = new Card($suit, $rank);
                $this->size++;
            }
        }
    }

    /** Returns an array of card objects representing the deck.
     *
     * @return array
     */
    public function getDeck(): array
    {
        return $this->deck;
    }

    /** Returns an array of arrays representing the cards in the deck.
     *
     * @return array
     */
    public function getJsonDeck(): array
    {
        $res = [];
        foreach ($this->deck as $card) {
            $res[] = $card->getJsonCard();
        }
        return $res;
    }

    /** Draws a number of cards from the array representing the deck.
     * Throws an exception if the number of cards is greater than the
     * length of the deck.
     *
     * @param int $countOfCards
     * @return array
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
        $this->size -= $countOfCards;
        return $drawnCards;
    }

    /** Shuffles the array representing the deck of cards.
     *
     * @return void
     */
    public function shuffle(): void
    {
        shuffle( $this->deck);
        $this->isShuffled = true;
    }

    /** Returns whether the array representing the deck of cards is shuffled or not.
     *
     * @return bool
     */
    public function isShuffled(): bool
    {
        return $this->isShuffled;
    }

    /** Returns the length of the deck, i.e. how many cards there still are in it.
     *
     * @return int
     */
    public function getLength(): int
    {
        return count($this->deck);
    }
}
