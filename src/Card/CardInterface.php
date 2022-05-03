<?php

namespace App\Card;

interface CardInterface
{
    /**
     * Getter for rank, suit and unicode of card.
     *
     * @return array<string, string>
     */
    public function getJsonCard(): array;

    /**
     * @return string
     */
    public function getRank(): string;

    /**
     * @return string
     */
    public function getSuit(): string;

    /**
     * @return string
     */
    public function getUnicode(): string;
}
