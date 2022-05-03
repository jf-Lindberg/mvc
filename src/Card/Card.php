<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

class Card implements CardInterface
{
    /**
     * @var string
     */
    private string $rank; #valör
    private string $suit; #färg
    private string $unicode;
    private int $value;

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
        $value = [
            'Joker' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            '10' => 10,
            'Knekt' => 11,
            'Dam' => 12,
            'Kung' => 13,
            'Ess' => 14
        ];
        $this->suit = $suit;
        $this->rank = $rank;
        $this->unicode = $unicode[$suit];
        $this->value = $value[$rank];
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

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
