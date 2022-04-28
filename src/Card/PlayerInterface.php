<?php

namespace App\Card;

use Exception;

interface PlayerInterface
{
    /**
     * Deals a new hand for the player
     *
     * @throws Exception
     * @return void
     */
    public function dealHand(int $cardAmount);

    /**
     * Gets player hand
     *
     * @return array<Card>
     */
    public function getHand(): array;

    /**
     * @return array<array<string, string>>
     */
    public function getJsonHand(): array;

    /**
     * Gets player id
     *
     * @return int
     */
    public function getPlayerId(): int;
}
