<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class GameExceptionTest extends TestCase
{
    public function testCreateNoArguments()
    {
        $this->expectException(\ArgumentCountError::class);
        $game = new Game();
    }

    public function testCreateOneArgument()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $this->expectException(\ArgumentCountError::class);
        $game = new Game($deck);
    }

    public function testCreateTwoArguments()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $this->expectException(\ArgumentCountError::class);
        $game = new Game($deck, $bank);
    }

    /**
     * @throws Over21Exception
     * @throws NotEnoughCardsException
     */
    public function testOver21ExceptionHitPlayer()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->createMock("\App\Card\Bank");
        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([0, 22])
            ->getMock();
        $player->method('getHandValue')->willReturn(26);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->expectException(Over21Exception::class);
        $res = $game->hitPlayer();
    }

    /**
     * @throws Over21Exception
     * @throws NotEnoughCardsException
     */
    public function testNotEnoughCardsExceptionHitPlayer()
    {
        $deck = $this->getMockBuilder("\App\Card\Deck")
            ->setConstructorArgs([4, 13])
            ->getMock();
        $deck->method('draw')->willThrowException(new NotEnoughCardsException());

        $bank = $this->createMock("\App\Card\Bank");

        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->expectException(NotEnoughCardsException::class);
        $res = $game->hitPlayer();
    }

    /**
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function testOver21ExceptionHitBank()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 22])
            ->getMock();
        $player = $this->createMock("\App\Card\Player");
        $bank->method('getHandValue')->willReturn(26);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->expectException(Over21Exception::class);
        $res = $game->hitBank();
    }

    /**
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function testNotEnoughCardsExceptionHitBank()
    {
        $deck = $this->getMockBuilder("\App\Card\Deck")
            ->setConstructorArgs([4, 13])
            ->getMock();
        $deck->method('draw')->willThrowException(new NotEnoughCardsException());

        $bank = $this->createMock("\App\Card\Bank");

        $player = $this->createMock("\App\Card\Player");

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->expectException(NotEnoughCardsException::class);
        $res = $game->hitBank();
    }

    /**
     * @throws BankDidNotStayException
     */
    public function testBankDidNotStayException()
    {
        $deck = $this->createMock("\App\Card\Deck");
        $bank = $this->getMockBuilder("\App\Card\Bank")
            ->setConstructorArgs([0, 21])
            ->getMock();
        $bank->method('isSetToStay')->willReturn(false);
        $bank->method('getHandValue')->willReturn(21);

        $player = $this->getMockBuilder("\App\Card\Player")
            ->setConstructorArgs([1, 21])
            ->getMock();
        $player->method('getHandValue')->willReturn(21);

        $game = new Game($deck, $bank, $player);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->expectException(BankDidNotStayException::class);
        $res = $game->playerWins();
    }
}
