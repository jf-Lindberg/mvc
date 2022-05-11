<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class CardExceptionTestTest extends TestCase
{
    /** Runs exception test for method that returns spring representation of the suit.
     *
     * @return void
     * @throws CardNotFoundException
     */
    public function testGetSuitAsString()
    {
        $card = new Card(6, 22);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->expectException(\App\Card\CardNotFoundException::class);
        $res = $card->getSuitAsString();
    }

    /** Runs exception test for method that returns spring representation of the rank.
     *
     * @return void
     * @throws CardNotFoundException
     */
    public function testGetRankAsString()
    {
        $card = new Card(6, 22);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->expectException(\App\Card\CardNotFoundException::class);
        $res = $card->getRankAsString();
    }

    /** Runs exception test for method that returns spring representation of the whole card.
     *
     * @return void
     * @throws CardNotFoundException
     */
    public function testGetAsString()
    {
        $card = new Card(5, 15);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->expectException(\App\Card\CardNotFoundException::class);
        $res = $card->stringify();
    }

    /** Runs exception test for method that returns spring representation of the whole card.
     *
     * @return void
     * @throws CardNotFoundException
     */
    public function testUnicode()
    {
        $card = new Card(-3, 24);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->expectException(\App\Card\CardNotFoundException::class);
        $res = $card->unicode();
    }

    /** Runs exception test for method that returns json representation of the whole card.
     * @return void
     * @throws CardNotFoundException
     */
    public function testJson()
    {
        $card = new Card(8, 20);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->expectException(\App\Card\CardNotFoundException::class);
        $res = $card->jsonify();
    }
}
