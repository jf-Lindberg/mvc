<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

class Card
{
    private string $rank; #valör
    private string $suit; #färg
    private string $unicode;

    public function __construct(string $suit, string $rank)
    {
        $unicode = [
            'Hjärter' => '&hearts;',
            'Spader' => '&spades;',
            'Ruter' => '&diams;',
            'Klöver' => '&clubs;',
            'Joker' => ''
        ];
        $this->suit = $suit;
        $this->rank = $rank;
        $this->unicode = $unicode[$suit];
    }

    /**
     * Getter for rank, suit and unicode of card.
     *
     * @return array
     */
    public function getCard(): array
    {
        return [
            "rank" => $this->rank,
            "suit" => $this->suit,
            "unicode" => $this->unicode
        ];
    }
}
