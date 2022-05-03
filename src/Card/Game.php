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

    /**
     * @throws Exception
     */
    public function dealPlayer ()
    {
        $hand = new Hand($this->deck);
        $hand->drawHand(1);
        $this->player->setHand($hand);
    }

    /**
     * @throws Exception
     */
    public function dealBank ()
    {
        $hand = new Hand($this->deck);
        $hand->drawHand(1);
        $this->bank->setHand($hand);
    }

    public function hit ()
    {

    }
}
