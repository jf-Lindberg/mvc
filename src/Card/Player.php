<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

use Exception;

class Player implements PlayerInterface
{
    /** Integer representing the ID of the player.
     *
     * @var int
     */
    private int $ident;

    /** Array representing the players hand.
     *
     * @var array<Card>
     */
    private array $cardsOnHand;

    /**
     * @var bool
     */
    private bool $stays;

    /** Constructor for the player class.
     * The class contains the player id and an array representing
     * a number of cards. It is possible to add, remove and get the cards
     * from an object of the class.
     *
     * @param int $playerId
     */
    public function __construct(int $playerId = 0)
    {
        $this->stays = false;
        $this->ident = $playerId;
        $this->cardsOnHand = [];
    }

    /** Adds cards to the array representing the player hand.
     *
     * @param array<Card> $cards
     * @return void
     */
    public function addCardsToHand(array $cards)
    {
        foreach ($cards as $card) {
            $this->cardsOnHand[] = $card;
        }
    }

    /** Removes cards from the array representing the player hand.
     *
     * @param array<Card> $cards
     * @return void
     */
    public function removeCards(array $cards)
    {
        foreach ($cards as $card) {
            unset($card, $this->cardsOnHand);
        }
    }

    public function resetCards(): void
    {
        $this->cardsOnHand = [];
    }

    /** Gets the player ID.
     *
     * @return int
     */
    public function getIdent(): int
    {
        return $this->ident;
    }

    /** Gets the array representing the cards on hand.
     *
     * @return array<Card>
     */
    public function getHand(): array
    {
        return $this->cardsOnHand;
    }

    /**
     * @return int
     */
    public function getHandValue(): int
    {
        return array_reduce($this->cardsOnHand, function ($carry, $card) {
            return $carry + $card->getRankValue();
        }, 0);
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

    public function setStays(bool $stayOrNot): void
    {
        $this->stays = $stayOrNot;
    }

    public function getStays(): bool
    {
        return $this->stays;
    }
}
