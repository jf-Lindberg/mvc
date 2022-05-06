<?php

namespace App\Card;

use Exception;

class Game
{
    private Deck $deck;
    private Bank $bank;
    private Player $player;

    public function __construct(Deck $deck, Bank $bank, Player $player)
    {
        $this->deck = $deck;
        $this->bank = $bank;
        $this->player = $player;
    }

    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitPlayer (int $cardsToDeal = 1)
    {
        $hand = $this->deck->draw($cardsToDeal);
        $this->player->addCardsToHand($hand);
        if ($this->player->getHandValue() > 21) {
            throw new Exception("Over 21");
        }
    }

    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitBank (int $cardsToDeal = 1)
    {
        $hand = $this->deck->draw($cardsToDeal);
        $this->bank->addCardsToHand($hand);
        if ($this->bank->getHandValue() > 21) {
            throw new Exception("Over 21");
        }
    }

    public function playerWins ()
    {
        $playerPoints = $this->player->getHandValue();
        $bankPoints = $this->bank->getHandValue();
        return $playerPoints > $bankPoints;
    }
}
