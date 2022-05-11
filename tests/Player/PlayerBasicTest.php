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

    /**
     * @return void
     */
    public function testAddingHand()
    {
        $player = new Player(1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $cardOne = $this->createMock('App\Card\Card');
        $cardTwo = $this->createMock('App\Card\Card');
        $cardThree = $this->createMock('App\Card\Card');
        $cardArray = [$cardOne, $cardTwo, $cardThree];

        $player->addCardsToHand($cardArray);

        $res = $player->getHand();
        $exp = $cardArray;
        $this->assertEquals($exp, $res);
    }

    /**
     * @return void
     */
    public function testResetCards()
    {
        $player = new Player(1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $cardOne = $this->createMock('App\Card\Card');
        $cardTwo = $this->createMock('App\Card\Card');
        $cardThree = $this->createMock('App\Card\Card');
        $cardArray = [$cardOne, $cardTwo, $cardThree];

        $player->addCardsToHand($cardArray);

        $player->resetCards();
        $res = $player->getHand();
        $notExp = $cardArray;
        $len = count($res);
        $this->assertNotEquals($notExp, $res);
        $this->assertTrue($len === 0);
    }

    /**
     * @return void
     */
    public function testGetIdent()
    {
        $player = new Player(5);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->getIdent();
        $exp = 5;
        $this->assertEquals($exp, $res);
        $type = gettype($res);
        $exp = "integer";
        $this->assertEquals($exp, $type);
    }

    /**
     * @return void
     */
    public function testGetHandValue()
    {
        $player = new Player(1, 17);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->getHandValue();
        $exp = 17;
        $this->assertEquals($exp, $res);
    }

    /**
     * @return void
     */
    public function testGetJson()
    {
        $player = new Player(1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $cardOne = $this->createMock('App\Card\Card');
        $cardTwo = $this->createMock('App\Card\Card');
        $cardThree = $this->createMock('App\Card\Card');
        $cardArray = [$cardOne, $cardTwo, $cardThree];

        $player->addCardsToHand($cardArray);

        $res = $player->getJsonHand();
        $this->assertIsArray($res);
        $this->assertIsArray($res[1]);
    }

    /**
     * @return void
     */
    public function testSetStays()
    {
        $player = new Player(1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->isSetToStay();
        $this->assertFalse($res);

        $player->setStays(true);
        $res = $player->isSetToStay();
        $this->assertTrue($res);
    }
}
