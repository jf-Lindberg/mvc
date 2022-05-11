<?php

namespace App\Card;

use App\Card\Card;
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
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $suitVal = $card->getSuitValue();
        $rankVal = $card->getRankValue();
        $this->assertTrue(0 <= $suitVal && $suitVal <= 4);
        $this->assertTrue(1 <= $rankVal && $rankVal <= 14);
    }

    /** Runs check for creating a Card object with one argument.
     *
     * @return void
     */
    public function testCreateOneArgument()
    {
        $card = new Card(0);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getSuitValue();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $card->getRankValue();
        $this->assertTrue(1 <= $res && $res <= 14);
    }

    /** Runs check for creating a Card object with both arguments.
     *
     * @return void
     */
    public function testCreateBothArguments()
    {
        $card = new Card(0, 14);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $suitVal = $card->getSuitValue();
        $rankVal = $card->getRankValue();
        $this->assertEquals(0, $suitVal);
        $this->assertEquals(14, $rankVal);
    }

    /** Runs test for method that returns spring representation of the suit.
     *
     * @return void
     */
    public function testGetSuitAsString()
    {
        $card = new Card(0, 14);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getSuitAsString();
        $exp = 'Spader';

        $this->assertEquals($exp, $res);
    }

    /** Runs test for method that returns spring representation of the rank.
     *
     * @return void
     */
    public function testGetRankAsString()
    {
        $card = new Card(0, 14);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getRankAsString();
        $exp = 'Ess';

        $this->assertEquals($exp, $res);
    }

    /** Runs test for method that returns spring representation of the whole card.
     *
     * @return void
     */
    public function testGetAsString()
    {
        $card = new Card(2, 12);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->stringify();
        $exp = 'Klöver Dam';

        $this->assertEquals($exp, $res);
    }

    /** Runs test for method that returns spring representation of the whole card.
     *
     * @return void
     */
    public function testUnicode()
    {
        $card = new Card(3, 11);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->unicode();
        $exp = '&#127179;';

        $this->assertEquals($exp, $res);
    }

    public function testJson()
    {
        $card = new Card(3, 11);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->jsonify();
        $exp = [
            "suit" => "Ruter",
            "rank" => "Knekt",
            "value" => 11,
            "unicode" => '&#127179;'
        ];

        $this->assertEquals($exp, $res);
    }
}
