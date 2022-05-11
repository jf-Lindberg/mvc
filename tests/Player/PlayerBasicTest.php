<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class PlayerBasicTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateNoArguments()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->isSetToStay();
        $this->assertFalse($res);

        $res = $player->getIdent();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $player->getHand();
        $exp = [];
        $this->assertEquals($exp, $res);
    }

    /**
     * @return void
     */
    public function testCreateWithArgument()
    {
        $player = new Player(1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->getIdent();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    public function testAddingHand()
    {
        $player = new Player(1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $cardOne = new Card(0, 5);
        $cardTwo = new Card(1, 12);
        $cardThree = new Card(3, 14);
        $cardArray = [$cardOne, $cardTwo, $cardThree];

        $player->addCardsToHand($cardArray);

        $res = $player->getHand();
        $exp = $cardArray;
        $this->assertEquals($exp, $res);
    }
}
