<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

use Exception;

class Player implements PlayerInterface
{
    private int $playerId;
    private HandInterface $hand;

    /**
     * Constructs a player.
     *
     * @param int $playerId
     * @param DeckInterface $deck
     */
    public function __construct(int $playerId, DeckInterface $deck)
    {
        $this->playerId = $playerId;
        $this->hand = new Hand($deck);
    }

    /**
     * Deals a new hand for the player
     *
     * @throws Exception
     * @return void
     */
    public function dealHand(int $cardAmount)
    {
        $this->hand->drawHand($cardAmount);
    }

    /**
     * Gets player hand
     *
     * @return array<Card>
     */
    public function getHand(): array
    {
        return $this->hand->getHand();
    }

    /**
     * @return array<array<string, string>>
     */
    public function getJsonHand(): array
    {
        $jsonHand = [];
        foreach ($this->hand->getHand() as $card) {
            $jsonHand[] = $card->getJsonCard();
        }
        return $jsonHand;
    }

    /**
     * Gets player id
     *
     * @return int
     */
    public function getPlayerId(): int
    {
        return $this->playerId;
    }
}
