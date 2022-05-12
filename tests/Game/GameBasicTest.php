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
}
