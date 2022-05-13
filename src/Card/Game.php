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
     * @return void
     * @throws DeckAlreadyExistsException
     * @throws NotEnoughCardsException
     * @throws Over21Exception
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
     * @return bool
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function hitPlayer(int $cardsToDeal = 1): bool
    {
        if (!$this->player->isSetToStay()) {
            $hand = $this->deck->draw($cardsToDeal);
            $this->player->addCardsToHand($hand);
            if ($this->player->getHandValue() > 21) {
                $this->player->setStays(true);
                $this->isGameDone = true;
                throw new Over21Exception("Over 21");
            }
            return true;
        }
        return false;
    }

    /**
     * @param int $cardsToDeal
     * @return array<Card>
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function hitBank(int $cardsToDeal = 1): array
    {
        $hand = $this->deck->draw($cardsToDeal);
        $this->bank->addCardsToHand($hand);
        if ($this->bank->getHandValue() > 21) {
            $this->isGameDone = true;
            throw new Over21Exception("Over 21");
        }
        return $hand;
    }

    /**
     * @return array<int, array<Card>>
     * @throws NotEnoughCardsException
     * @throws Over21Exception
     */
    public function playBank(): array
    {
        $this->player->setStays(true);
        $roundFinished = $this->isRoundFinished();
        if (!$roundFinished) {
            $cardsHit = [];
            while ($this->bank->decidesToHit()) {
                $cardsHit[] = $this->hitBank();
            }
            $this->bank->setStays(true);
            $this->isGameDone = true;
            return $cardsHit;
        }
        return [];
    }

    /**
     * @throws BankDidNotStayException
     */
    public function playerWins(): bool
    {
        if ($this->bank->isSetToStay()) {
            $playerPoints = $this->player->getHandValue();
            $bankPoints = $this->bank->getHandValue();
            $this->isGameDone = true;
            return $playerPoints > $bankPoints;
        }
        throw new BankDidNotStayException("Bank didn't stay");
    }

    public function setIsGameDone(bool $val): void
    {
        $this->isGameDone = $val;
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
