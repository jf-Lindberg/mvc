<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    /**
     * @Route("/card", name="card-home")
     */
    public function card(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("/card/deck", name="card-deck")
     */
    public function deck(): Response
    {
        $deck = new \App\Card\Deck();
        $data = [
            "deckArr" => $deck->getDeck()
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/shuffle", name="card-shuffle")
     */
    public function shuffle(): Response
    {
        $deck = new \App\Card\Deck();
        $deck->shuffle();
        $data = [
            "deckArr" => $deck->getDeck()
        ];
        return $this->render('card/shuffle.html.twig', $data);
    }

    /**
     * @Route("/card/draw", name="card-draw")
     */
    public function draw(): Response
    {
        $deck = new \App\Card\Deck();
        $card = $deck->draw();
        $data = [
            "card" => $card->getCardAsArray(),
            "amountLeft" => count($deck->getDeck())
        ];
        return $this->render('card/draw.html.twig', $data);
    }
}
