<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

class Card
{
    protected string $rank; #valör
    protected string $suit; #färg
    protected string $unicode;

    /**
     * Getter for rank and suit of card.
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

    /**
     * Setter for rank and suit of card.
     *
     * @param string $rank
     * @param string $suit
     * @return void
     */
    public function setCard(string $suit, string $rank): void
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
}
