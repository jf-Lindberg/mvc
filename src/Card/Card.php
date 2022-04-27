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
     * @return array<string, string>
     */
    public function getJsonCard(): array
    {
        return [
            "suit" => $this->getSuit(),
            "rank" => $this->getRank(),
            "unicode" => $this->getUnicode()
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
