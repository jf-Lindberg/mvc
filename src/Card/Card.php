<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

class Card
{
    /**
     * @var string
     */
    private string $rank; #valör
    private string $suit; #färg
    private string $unicode;

    /*** Constructor for Card. Includes suit, rank and unicode.
     * @param string $suit
     * @param string $rank
     */
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
     * @return array<string, string>
     */
    public function getJsonCard(): array
    {
        return [
            "suit" => $this->suit,
            "rank" => $this->rank,
            "unicode" => $this->unicode
        ];
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }

    /**
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * @return string
     */
    public function getUnicode(): string
    {
        return $this->unicode;
    }
}
