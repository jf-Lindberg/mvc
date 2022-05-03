<?php

namespace App\Card;

use Exception;

interface HandInterface
{
    /**
     * Draws a new hand.
     *
     * @throws Exception
     * @return void
     */
    public function drawHand(int $cardAmount);

    /**
     * Gets current hand.
     *
     * @return array<Card>
     */
    public function getHand(): array;
}
