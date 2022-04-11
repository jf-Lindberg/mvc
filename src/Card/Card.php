<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;



class Card
{
    protected string $rank; #valör
    protected string $suit; #färg

    /**
     * Getter for rank and suit of card.
     *
     * @return array
     */
    public function getCardArr(): array
    {
        return [$this->rank, $this->suit];
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
        $this->suit = $suit;
        $this->rank = $rank;
    }

    /** Returns the rank and suit of the card.
     *
     * @return array
     */
    public function getCardAsArray(): array
    {
        $suits = [
            0 => '&hearts;',
            1 => '&spades;',
            2 => '&diams;',
            3 => '&clubs;',
            4 => ''
        ];

        $ranks = [
            0 => 'Joker',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => 'Knekt',
            12 => 'Dam',
            13 => 'Kung',
            14 => 'Ess'
        ];

        return [$ranks[$this->rank], $suits[$this->suit]];
    }
}
