<?php

namespace App\Card;

class Deck2 extends Deck implements DeckInterface
{
    /**
     * Adds two jokers compared with normal deck.
     *
     * @return void
     */
    public function createDeck(): void
    {
        parent::createDeck();
        for ($i = 0; $i < 2; $i++) {
            $this->deck[$this->size] = new Card(4, 1);
            $this->size++;
        }
    }
}
