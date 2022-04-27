<?php

namespace App\Card;

interface CardInterface
{
    /**
     * Getter for rank, suit and unicode of card.
     *
     * @return array<string, string>
     */
    public function getCard(): array;
}
