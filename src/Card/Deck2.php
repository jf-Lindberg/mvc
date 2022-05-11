<?php

namespace App\Card;

class Deck2 extends Deck implements DeckInterface
{
    /**
     * Adds two jokers compared with normal deck.
     *
     * @param int $suits
     * @param int $ranks
     * @return void
     */
    public function addCardsToDeck(int $suits = 4, int $ranks = 13): void
    {
        parent::addCardsToDeck();
        for ($i = 0; $i < 2; $i++) {
            $this->deck[$this->size] = new Card(4, 1);
            $this->size++;
        }
    }
}
