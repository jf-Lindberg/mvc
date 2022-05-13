<?php

namespace App\Card;

use Exception;

interface GameInterface
{
    /**
     * @param int $cardsToDeal
     * @return bool
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function hitPlayer(int $cardsToDeal): bool;

    /**
     * @param int $cardsToDeal
     * @return array<Card>
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function hitBank(int $cardsToDeal): array;

    public function playerWins(): bool;

    public function isRoundFinished(): bool;
}
