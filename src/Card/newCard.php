<?php

namespace App\Card;

use Exception;

class newCard
{
    private int $suitValue;
    private int $rankValue;

    public function __construct(int $suitValue, int $rankValue)
    {
        $this->suitValue = $suitValue;
        $this->rankValue = $rankValue;
    }

//    public function getSuitValue(): int
//    {
//        return $this->suitValue;
//    }
//
//    public function getRankValue(): int
//    {
//        return $this->rankValue;
//    }

    public function getSuit(): string
    {
        $suits = [
            0 => 'Spader',
            1 => 'Hjärter',
            2 => 'Klöver',
            3 => 'Ruter',
            4 => 'Joker'
        ];

        return $suits[$this->suitValue];
    }

    public function getRank(): string
    {
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

    public function getCardAsString(): string
    {
        return $this->getSuit() . " " . $this->getRank();
    }

    public function getUnicode(): string
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
            'Hjärter Ess' => '&#127153;',
            'Hjärter 2' => '&#127154;',
            'Hjärter 3' => '&#127155;',
            'Hjärter 4' => '&#127156;',
            'Hjärter 5' => '&#127157;',
            'Hjärter 6' => '&#127158;',
            'Hjärter 7' => '&#127159;',
            'Hjärter 8' => '&#127160;',
            'Hjärter 9' => '&#127161;',
            'Hjärter 10' => '&#127162;',
            'Hjärter Knekt' => '&#127163;',
            'Hjärter Dam' => '&#127165;',
            'Hjärter Kung' => '&#127166;',
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
            'Klöver Ess' => '&#127185;',
            'Klöver 2' => '&#127186;',
            'Klöver 3' => '&#127187;',
            'Klöver 4' => '&#127188;',
            'Klöver 5' => '&#127189;',
            'Klöver 6' => '&#127190;',
            'Klöver 7' => '&#127191;',
            'Klöver 8' => '&#127192;',
            'Klöver 9' => '&#127193;',
            'Klöver 10' => '&#127194;',
            'Klöver Knekt' => '&#127195;',
            'Klöver Dam' => '&#127197;',
            'Klöver Kung' => '&#127198;',
            'Joker' => '&#127199;'
        ];

        $card = $this->getCardAsString();
        return $unicode[$card];
    }

//    public function getCardAsArray(): array
//    {
//        return [
//            "suit" => $this->getSuitAsString(),
//            "rank" => $this->getRankAsString(),
//            "unicode" => $this->getCardAsUnicode()
//        ];
//    }
}
