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
     * Returns an array of cards representing the deck.
     *
     * @return array<mixed>
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
     * Draws a card from the deck.
     *
     * @param int $countOfCards
     * @return array<mixed>
     */
    public function draw(int $countOfCards): array;
}
