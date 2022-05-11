<?php

namespace App\Card;

use Exception;

class Game implements GameInterface
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
     * @throws Exception
     */
    public function newRound(): void
    {
        $this->isGameDone = false;
        $this->bank->setStays(false);
        $this->player->setStays(false);
        $this->deck->reset();
        $this->player->resetCards();
        $this->bank->resetCards();
        $this->hitPlayer();
    }

    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitPlayer(int $cardsToDeal = 1): void
    {
        if (!$this->player->isSetToStay()) {
            $hand = $this->deck->draw($cardsToDeal);
            $this->player->addCardsToHand($hand);
            if ($this->player->getHandValue() > 21) {
                $this->player->setStays(false);
                $this->isGameDone = true;
                throw new Exception("Over 21");
            }
        }
    }

    /**
     * @param int $cardsToDeal
     * @throws Exception
     */
    public function hitBank(int $cardsToDeal = 1): void
    {
        $hand = $this->deck->draw($cardsToDeal);
        $this->bank->addCardsToHand($hand);
        if ($this->bank->getHandValue() > 21) {
            $this->isGameDone = true;
            throw new Exception("Over 21");
        }
    }

    /**
     * @throws Exception
     */
    public function playBank(): void
    {
        $this->player->setStays(true);
        if (!$this->isRoundFinished()) {
            while ($this->bank->decidesToHit()) {
                $this->hitBank();
            }
            $this->bank->setStays(true);
            $this->isGameDone = true;
        }
    }

    /**
     * @throws Exception
     */
    public function playerWins(): bool
    {
        if ($this->bank->isSetToStay()) {
            $playerPoints = $this->player->getHandValue();
            $bankPoints = $this->bank->getHandValue();
            $this->isGameDone = true;
            return $playerPoints > $bankPoints;
        }
        throw new Exception("Bank didn't stay");
    }

    public function isRoundFinished(): bool
    {
        return $this->isGameDone;
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }
}
