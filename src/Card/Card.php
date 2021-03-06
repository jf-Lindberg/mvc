<?php

/**
 * @author Filip Lindberg
 */

namespace App\Card;

class Card implements CardInterface
{
    /** Integer representing the cards suit:
     *  0 -> Spades
     *  1 -> Hearts
     *  2 -> Clubs
     *  3 -> Square
     *  4 -> Joker
     *
     * @var int
     */
    private int $suitValue;

    /** Holds the value of the cards which also represents the rank:
     *  1 => '1',
     *  2 => '2',
     *  3 => '3',
     *  4 => '4',
     *  5 => '5',
     *  6 => '6',
     *  7 => '7',
     *  8 => '8',
     *  9 => '9',
     *  10 => '10',
     *  11 => 'Knekt',
     *  12 => 'Dam',
     *  13 => 'Kung',
     *  14 => 'Ess'
     *
     * @var int
     */
    private int $rankValue;

    /** Constructor for the card class.
     * The class contains the suit, value and rank of the card.
     * There are methods that can return the values in a number of formats
     * including integers, arrays and unicode.
     *
     * @param int $suitValue
     * @param int $rankValue
     */
    public function __construct(int $suitValue = -1, int $rankValue = -1)
    {
        $this->suitValue = $suitValue;
        $this->rankValue = $rankValue;
        if ($suitValue === -1) {
            $this->randomizeSuit();
        }
        if ($rankValue === -1) {
            $this->randomizeRank();
        }
    }

    /** Generates a random suit.
     *
     * @return void
     */
    public function randomizeSuit()
    {
        $this->suitValue = rand(0, 4);
    }

    /** Generates a random rank.
     *
     * @return void
     */
    public function randomizeRank()
    {
        $this->rankValue = rand(1, 14);
    }

    /** Gets the value representing the suit.
     *
     * @return int
     */
    public function getSuitValue(): int
    {
        return $this->suitValue;
    }

    /** Gets the value representing the rank.
     *
     * @return int
     */
    public function getRankValue(): int
    {
        return $this->rankValue;
    }

    /** Gets the string value representing the suit.
     *
     * @return string
     * @throws CardNotFoundException
     */
    public function getSuitAsString(): string
    {
        if ($this->suitValue < 0 || $this->suitValue > 4) {
            throw new CardNotFoundException("That suit does not exist.");
        }

        $suits = [
            0 => 'Spader',
            1 => 'Hj??rter',
            2 => 'Kl??ver',
            3 => 'Ruter',
            4 => 'Joker'
        ];

        return $suits[$this->suitValue];
    }

    /** Gets the string value representing the rank.
     *
     * @return string
     * @throws CardNotFoundException
     */
    public function getRankAsString(): string
    {
        if ($this->rankValue < 1 || $this->rankValue > 14) {
            throw new CardNotFoundException("That rank does not exist.");
        }

        $ranks = [
            1 => '1',
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

        return $ranks[$this->rankValue];
    }

    /** Gets the entire card as a string.
     *
     * @return string
     * @throws CardNotFoundException
     */
    public function stringify(): string
    {
        return $this->getSuitAsString() . " " . $this->getRankAsString();
    }

    /** Returns the unicode representation of a given card.
     *
     * @return string
     * @throws CardNotFoundException
     */
    public function unicode(): string
    {
        $unicode = [
            'Spader Ess' => '&#127137;',
            'Spader 2' => '&#127138;',
            'Spader 3' => '&#127139;',
            'Spader 4' => '&#127140;',
            'Spader 5' => '&#127141;',
            'Spader 6' => '&#127142;',
            'Spader 7' => '&#127143;',
            'Spader 8' => '&#127144;',
            'Spader 9' => '&#127145;',
            'Spader 10' => '&#127146;',
            'Spader Knekt' => '&#127147;',
            'Spader Dam' => '&#127149;',
            'Spader Kung' => '&#127150;',
            'Hj??rter Ess' => '&#127153;',
            'Hj??rter 2' => '&#127154;',
            'Hj??rter 3' => '&#127155;',
            'Hj??rter 4' => '&#127156;',
            'Hj??rter 5' => '&#127157;',
            'Hj??rter 6' => '&#127158;',
            'Hj??rter 7' => '&#127159;',
            'Hj??rter 8' => '&#127160;',
            'Hj??rter 9' => '&#127161;',
            'Hj??rter 10' => '&#127162;',
            'Hj??rter Knekt' => '&#127163;',
            'Hj??rter Dam' => '&#127165;',
            'Hj??rter Kung' => '&#127166;',
            'Ruter Ess' => '&#127169;',
            'Ruter 2' => '&#127170;',
            'Ruter 3' => '&#127171;',
            'Ruter 4' => '&#127172;',
            'Ruter 5' => '&#127173;',
            'Ruter 6' => '&#127174;',
            'Ruter 7' => '&#127175;',
            'Ruter 8' => '&#127176;',
            'Ruter 9' => '&#127177;',
            'Ruter 10' => '&#127178;',
            'Ruter Knekt' => '&#127179;',
            'Ruter Dam' => '&#127181;',
            'Ruter Kung' => '&#127182;',
            'Kl??ver Ess' => '&#127185;',
            'Kl??ver 2' => '&#127186;',
            'Kl??ver 3' => '&#127187;',
            'Kl??ver 4' => '&#127188;',
            'Kl??ver 5' => '&#127189;',
            'Kl??ver 6' => '&#127190;',
            'Kl??ver 7' => '&#127191;',
            'Kl??ver 8' => '&#127192;',
            'Kl??ver 9' => '&#127193;',
            'Kl??ver 10' => '&#127194;',
            'Kl??ver Knekt' => '&#127195;',
            'Kl??ver Dam' => '&#127197;',
            'Kl??ver Kung' => '&#127198;',
            'Joker 1' => '&#127199;'
        ];

        $card = $this->stringify();
        return $unicode[$card];
    }

    /** Returns an array representing the card in a JSON-friendly format.
     *
     * @return array<string, mixed>
     * @throws CardNotFoundException
     */
    public function jsonify(): array
    {
        return [
            "suit" => $this->getSuitAsString(),
            "rank" => $this->getRankAsString(),
            "value" => $this->getRankValue(),
            "unicode" => $this->unicode()
        ];
    }
}
