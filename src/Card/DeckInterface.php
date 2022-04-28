<?php

namespace App\Card;

use Exception;

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
     * @return array<CardInterface>
     */
    public function getDeck(): array;

    /** Returns array of arrays consisting of card values
     *
     * @return array<array<string, string>>
     */
    public function getJsonDeck(): array;

    /**
     * @param int $countOfCards
     * @return array<Card>
     * @throws Exception
     */
    public function draw(int $countOfCards): array;

    /**
     * Shuffles all cards in the deck.
     *
     * @return void
     */
    public function shuffle(): void;

    /**
     * Returns whether deck is shuffled or not.
     *
     * @return bool
     */
    public function isShuffled(): bool;

    /**
     * Returns remainder of cards in the deck
     *
     * @return int
     */
    public function getLength(): int;
}
