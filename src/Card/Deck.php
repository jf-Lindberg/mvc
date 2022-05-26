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
     * @throws DeckAlreadyExistsException
     */
    public function __construct()
    {
        $this->size = 0;
        $this->deck = [];
        $this->isShuffled = false;
        $this->addCardsToDeck();
    }

    /** Adds card objects to the array representing the deck.
     *
     * @param int $suits
     * @param int $ranks
     * @return void
     * @throws DeckAlreadyExistsException
     */
    public function addCardsToDeck(int $suits = 4, int $ranks = 13): void
    {
        if ($this->size > 0) {
            throw new DeckAlreadyExistsException("That deck already contains cards.");
        }
        for ($suit = 0; $suit < $suits; $suit++) {
            for ($rank = 2; $rank < $ranks + 2; $rank++) {
                $this->deck[$this->size] = new Card($suit, $rank);
                $this->size++;
            }
        }
    }

    /** Returns an array of card objects representing the deck.
     *
     * @return array<Card>
     */
    public function get(): array
    {
        return $this->deck;
    }

    /** Returns an array of arrays representing the cards in the deck.
     *
     * @return array<array<string, string>>
     */
    public function jsonify(): array
    {
        $res = [];
        foreach ($this->deck as $card) {
            $res[] = $card->jsonify();
        }
        return $res;
    }

    /** Draws a number of cards from the array representing the deck.
     * Throws an exception if the number of cards is greater than the
     * length of the deck.
     *
     * @param int $countOfCards
     * @return array<Card>
     * @throws NotEnoughCardsException
     */
    public function draw(int $countOfCards = 1): array
    {
        $drawnCards = [];
        if ($this->getLength() - $countOfCards < 0) {
            throw new NotEnoughCardsException("Not enough cards");
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
        shuffle($this->deck);
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

    public function removeAllCards(): void
    {
        $this->size = 0;
        $this->deck = [];
    }

    /**
     * @param int $size
     * @param array<Card> $deck
     * @return void
     * @throws DeckAlreadyExistsException
     */
    public function reset(int $size = 0, array $deck = []): void
    {
        $this->size = $size;
        $this->deck = $deck;
        $this->isShuffled = false;
        $this->addCardsToDeck();
        $this->shuffle();
    }
}
