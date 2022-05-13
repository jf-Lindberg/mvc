<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class GameBasicTest extends TestCase
{
    public function testCreateAllArguments()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->isRoundFinished();
        $this->assertFalse($res);

        $res = $game->getBank();
        $this->assertEquals($bank, $res);

        $res = $game->getPlayer();
        $this->assertEquals($player, $res);
    }

    /**
     * @throws NotEnoughCardsException
     * @throws DeckAlreadyExistsException
     * @throws Over21Exception
     */
    public function testNewRound()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $game->setIsGameDone(true);
        $res = $game->isRoundFinished();
        $this->assertTrue($res);

        $game->newRound();
        $res = $game->isRoundFinished();
        $this->assertFalse($res);
    }

    /**
     * @return void
     */
    public function testIsGameDone()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->isRoundFinished();
        $this->assertFalse($res);

        $game->setIsGameDone(true);
        $res = $game->isRoundFinished();
        $this->assertTrue($res);
    }

    /**
     * @throws Over21Exception
     * @throws NotEnoughCardsException
     */
    public function testHitPlayer()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([0, 0])
            ->getMock();

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->hitPlayer();
        $this->assertTrue($res);
    }

    /**
     * @throws Over21Exception
     * @throws NotEnoughCardsException
     */
    public function testHitWhenPlayerStayed()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([0, 0])
            ->getMock();
        $player->method('isSetToStay')->willReturn(true);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->hitPlayer();
        $this->assertFalse($res);
    }

    /**
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function testHitBank()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->hitBank();
        $this->assertIsArray($res);
    }

    /**
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function testPlayBankNoWhile()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 0])
            ->getMock();
        $bank->method('decidesToHit')->willReturn(false);
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->isRoundFinished();
        $this->assertFalse($res);

        $game->playBank();
        $res = $game->isRoundFinished();
        $this->assertTrue($res);
    }

    /**
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function testPlayBankWithWhile()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 0])
            ->getMock();
        $bank->method('decidesToHit')->will($this->onConsecutiveCalls(true, true, false));
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->playBank();
        $this->assertIsArray($res);

        $len = count($res);
        $exp = 2;
        $this->assertEquals($exp, $len);
    }

    /**
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function testPlayBankWhenRoundFinished()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 0])
            ->getMock();
        $bank->method('decidesToHit')->will($this->onConsecutiveCalls(true, true, false));
        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $game->setIsGameDone(true);

        $res = $game->playBank();
        $this->assertIsArray($res);

        $len = count($res);
        $exp = 0;
        $this->assertEquals($exp, $len);
    }

    public function testPlayerLessPoints()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 17])
            ->getMock();
        $bank->method('isSetToStay')->willReturn(true);
        $bank->method('getHandValue')->willReturn(17);

        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([1, 15])
            ->getMock();
        $player->method('getHandValue')->willReturn(15);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->playerWins();
        $this->assertFalse($res);
    }

    /**
     * @throws BankDidNotStayException
     */
    public function testPlayerMorePoints()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 18])
            ->getMock();
        $bank->method('isSetToStay')->willReturn(true);
        $bank->method('getHandValue')->willReturn(18);

        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([1, 21])
            ->getMock();
        $player->method('getHandValue')->willReturn(21);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->playerWins();
        $this->assertTrue($res);
    }

    /**
     * @throws BankDidNotStayException
     */
    public function testPlayerEqualPoints()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 21])
            ->getMock();
        $bank->method('isSetToStay')->willReturn(true);
        $bank->method('getHandValue')->willReturn(21);

        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([1, 21])
            ->getMock();
        $player->method('getHandValue')->willReturn(21);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $res = $game->playerWins();
        $this->assertFalse($res);
    }
}
