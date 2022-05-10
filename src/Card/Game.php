<?php

namespace App\Card;

use Exception;

class Game
{
    private Deck $deck;
    private Bank $bank;
    private Player $player;
    private bool $isGameDone;

    public function __construct(Deck $deck, Bank $bank, Player $player)
    {
        $this->deck = $deck;
        $this->bank = $bank;
        $this->player = $player;
        $this->isGameDone = false;
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
            $this->isGameDone = true;
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
            $this->isGameDone = true;
            throw new Exception("Over 21");
        }
    }

    public function playerWins (): bool
    {
        $playerPoints = $this->player->getHandValue();
        $bankPoints = $this->bank->getHandValue();
        $this->isGameDone = true;
        return $playerPoints > $bankPoints;
    }

    public function isRoundFinished (): bool
    {
        return $this->isGameDone;
    }
}
