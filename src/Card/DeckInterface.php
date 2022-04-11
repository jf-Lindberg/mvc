<?php

namespace App\Card;

interface DeckInterface
{
    /**
     * Creates a deck.
     *
     * @return void
     */
    public function createDeck(): void;

    /**
     * Returns an array with the "stringified" deck.
     *
     * @return array
     */
    public function getDeck(): array;

    /**
     * Returns remainder of cards in the deck
     *
     * @return int length of deck
     */
    public function getLength(): int;

    /** Shuffles all the cards in the deck.
     *
     * @return void
     */
    public function shuffle(): void;

    /**
     * Draws a random card from the deck.
     *
     * @param int $countOfCards
     * @return array
     */
    public function draw(int $countOfCards): array;
}
