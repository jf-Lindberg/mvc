<?php

namespace App\Card;

interface CardInterface
{
    /**
     * Getter for rank, suit and unicode of card.
     *
     * @return array<string, mixed>
     */
    public function jsonify(): array;

    /**
     * @return string
     */
    public function getRankAsString(): string;

    /**
     * @return string
     */
    public function getSuitAsString(): string;

    /**
     * @return string
     */
    public function unicode(): string;
}
