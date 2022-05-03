<?php

namespace App\Card;

use Exception;

class Game
{
    private Deck $deck;
    private Player $player;

    public function __construct(Deck $deck, Player $player)
    {
        $this->deck = $deck;
        $this->player = $player;
    }

    /**
     * @throws Exception
     */
    public function dealPlayer (int $cardsToDeal = 1)
    {
        $hand = $this->deck->draw($cardsToDeal);
        $this->player->addCardsToHand($hand);
    }
}
