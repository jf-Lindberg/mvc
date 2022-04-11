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

    public function __construct(int $id, Deck $deck)
    {
        $this->id = $id;
        $this->hand = new Hand($deck);
    }

    /**
     * @throws Exception
     */
    public function dealHand(int $cardAmount)
    {
        $this->hand->drawHand($cardAmount);
    }

    /**
     * @return array
     */
    public function getHand(): array
    {
        return $this->hand->getHand();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
