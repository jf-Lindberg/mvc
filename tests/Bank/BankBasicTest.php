<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class CardBasicTest extends TestCase
{
    // SKREV CARD ANNORLUNDA FÖR ATT KUNNA TESTA ATT KLASSEN FUNKAR UTAN ARGUMENT
    // OCH MED ETT ARGUMENT
    /** Runs check for creating a Card object with no arguments.
     *
     * @return void
     */
    public function testCreateCardNoArguments()
    {
        $bank = new Bank();
        $this->assertInstanceOf("\App\Card\Card", $bank);

        $suitVal = $card->getSuitValue();
        $rankVal = $card->getRankValue();
        $this->assertTrue(0 <= $suitVal && $suitVal <= 4);
        $this->assertTrue(1 <= $rankVal && $rankVal <= 14);
    }
}
