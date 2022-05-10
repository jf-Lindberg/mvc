<?php

namespace App\Card;

use Exception;

interface GameInterface
{
    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitPlayer(int $cardsToDeal): void;

    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitBank(int $cardsToDeal): void;

    public function playerWins(): bool;

    public function isRoundFinished(): bool;
}
