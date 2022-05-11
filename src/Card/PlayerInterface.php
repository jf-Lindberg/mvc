<?php

namespace App\Card;

use Exception;

interface PlayerInterface
{
    /** Adds cards to the array representing the player hand.
     *
     * @param array<Card> $cards
     * @return void
     */
    public function addCardsToHand(array $cards);

    /**
     * Gets player hand
     *
     * @return array<Card>
     */
    public function getHand(): array;

    /**
     * @return int
     */
    public function getHandValue(): int;

    /** Gets the array representing the cards on hand
     * in a JSON-friendly format.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getJsonHand(): array;

    /** Gets the player ID.
     *
     * @return int
     */
    public function getIdent(): int;
}
