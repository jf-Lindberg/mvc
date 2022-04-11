<?php

namespace App\Card;

class Deck2 extends Deck implements DeckInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function createDeck(): void
    {
        parent::createDeck();
        for ($i = 0; $i < 2; $i++) {
            $card = new Card();
            $card->setCard(4, 0);
            $this->deck[] = $card;
        }
    }
}
