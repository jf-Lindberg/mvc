<?php

namespace App\Card;

use Exception;

interface GameInterface
{
    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitPlayer (int $cardsToDeal);

    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitBank (int $cardsToDeal);

    public function playerWins (): bool;

    public function isRoundFinished (): bool;
}
