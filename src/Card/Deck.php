<?php

namespace App\Card;

use Exception;

class Deck implements DeckInterface
{
    protected int $size;
    protected array $deck;
    private bool $isShuffled;

    public function __construct()
    {
        $this->size = 0;
        $this->deck = [];
        $this->isShuffled = false;
        $this->createDeck();
    }

    /**
     * Creates a deck.
     *
     * @return void
     */
    public function createDeck(): void
    {
//        $this->deck = [];
//        $ranks = ['Joker', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Knekt', 'Dam', 'Kung', 'Ess'];
//        $suits = ['Hjärter', 'Spader', 'Ruter', 'Klöver'];
//        for ($i = 0; $i < 4; $i++) {
//            for ($j = 1; $j < 14; $j++) {
//                $card = new Card($suits[$i], $ranks[$j]);
//                $this->deck[] = $card;
//            }
//        }

        for ($suit = 0; $suit <= 3; $suit++) {
            for ($rank = 2; $rank <= 14; $rank++) {
                $this->deck[$this->size] = new Card($suit, $rank);
                $this->size++;
            }
        }
    }

    public function getDeck(): array
    {
        return $this->deck;
    }

    public function getJsonDeck(): array
    {
        $res = [];
        foreach ($this->deck as $card) {
            $res[] = $card->getJsonCard();
        }
        return $res;
    }

    public function draw(int $countOfCards): array
    {
        $drawnCards = [];
        if ($this->getLength() - $countOfCards < 0) {
            throw new Exception("Not enough cards");
        }
        for ($i = 0; $i < $countOfCards; $i++) {
            $card = array_splice($this->deck, ($this->getLength() - 1), 1);
            $drawnCards[] = $card[0];
        }
        return $drawnCards;
    }

    public function shuffle(): void
    {
        shuffle( $this->deck);
        $this->isShuffled = true;
    }

    public function isShuffled(): bool
    {
        return $this->isShuffled;
    }

    public function getLength(): int
    {
        return count($this->deck);
    }
}
