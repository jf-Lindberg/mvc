<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

use Exception;

class Player
{
    /** Integer representing the ID of the player.
     *
     * @var int
     */
    private int $playerId;

    /** Array representing the players hand.
     *
     * @var array<Card>
     */
    private array $cardsOnHand;

    /** Constructor for the player class.
     * The class contains the player id and an array representing
     * a number of cards. It is possible to add, remove and get the cards
     * from an object of the class.
     *
     * @param int $playerId
     */
    public function __construct(int $playerId)
    {
        $this->playerId = $playerId;
    }

    /** Adds cards to the array representing the player hand.
     *
     * @param array<Card> $cards
     * @return void
     */
    public function addCardsToHand(array $cards) {
        foreach ($cards as $card) {
            $this->cardsOnHand[] = $card;
        }
    }

    /** Removes cards from the array representing the player hand.
     *
     * @param array $cards
     * @return void
     */
    public function removeCards(array $cards) {
        foreach ($cards as $card) {
            unset($card, $this->cardsOnHand);
        }
    }

    /** Gets the player ID.
     *
     * @return int
     */
    public function getPlayerId(): int
    {
        return $this->playerId;
    }

    /** Gets the array representing the cards on hand.
     *
     * @return array
     */
    public function getHand(): array
    {
        return $this->cardsOnHand;
    }

    /** Gets the array representing the cards on hand
     * in a JSON-friendly format.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getJsonHand(): array
    {
        $jsonHand = [];
        foreach ($this->cardsOnHand as $card) {
            $jsonHand[] = $card->getJsonCard();
        }
        return $jsonHand;
    }
}
