<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

use Exception;

class Player
{
    private int $id;
    private Hand $hand;

    /**
     * Constructs a player.
     *
     * @param int $id
     * @param Deck $deck
     */
    public function __construct(int $id, Deck $deck)
    {
        $this->id = $id;
        $this->hand = new Hand($deck);
    }

    /**
     * Deals a new hand for the player
     *
     * @throws Exception
     */
    public function dealHand(int $cardAmount)
    {
        $this->hand->drawHand($cardAmount);
    }

    /**
     * Gets player hand
     *
     * @return array
     */
    public function getHand(): array
    {
        return $this->hand->getHand();
    }

    /**
     * Gets player id
     *
     * @return int id
     */
    public function getId(): int
    {
        return $this->id;
    }
}
