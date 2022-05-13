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
     * @var int
     */
    private int $score;

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
     * @param int $score
     */
    public function __construct(int $playerId = 0, int $score = 0)
    {
        $this->score = $score;
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
            $this->score += $card->getRankValue();
        }
    }

    public function resetCards(): void
    {
        $this->cardsOnHand = [];
        $this->score = 0;
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
        return $this->score;
//        return array_reduce($this->cardsOnHand, function ($carry, $card) {
//            return $carry + $card->getRankValue();
//        }, 0);
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
            $jsonHand[] = $card->jsonify();
        }
        return $jsonHand;
    }

    /**
     * @param bool $stayOrNot
     * @return void
     */
    public function setStays(bool $stayOrNot): void
    {
        $this->stays = $stayOrNot;
    }

    /**
     * @return bool
     */
    public function isSetToStay(): bool
    {
        return $this->stays;
    }
}
