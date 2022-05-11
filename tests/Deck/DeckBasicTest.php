<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class DeckBasicTest extends TestCase
{
    public function testCreateNoArguments()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->getLength();
        $exp = 52;
        $this->assertEquals($exp, $res);

        $res = $deck->getDeck();
        $this->assertIsArray($res);

        $res = $deck->isShuffled();
        $this->assertFalse($res);
    }
}
