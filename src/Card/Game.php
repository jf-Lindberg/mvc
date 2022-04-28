<?php

namespace App\Card;

use Exception;

class Game
{
    private DeckInterface $deck;
    private BankInterface $bank;
    private PlayerInterface $player;

    public function __construct(DeckInterface $deck, BankInteface $bank, PlayerInterface $player)
    {
        $this->deck = $deck;
        $this->bank = $bank;
        $this->player = $player;
    }
}
