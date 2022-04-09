<?php

namespace App\Card;

interface DeckInterface
{
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
