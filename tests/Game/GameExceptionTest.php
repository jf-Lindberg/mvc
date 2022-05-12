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
}
