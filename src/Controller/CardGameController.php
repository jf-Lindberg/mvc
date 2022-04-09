<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    /**
     * @Route("/card", name="card-home")
     */
    public function card(): Response
    {
        $data = [
            "title" => "Card"
        ];
        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck", name="card-deck")
     */
    public function deck(
        SessionInterface $session
    ): Response
    {
        $deck = new \App\Card\Deck();
        $session->set("deck", $deck);
        $data = [
            "title" => "Deck",
            "deckArr" => $deck->getDeck()
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="card-shuffle")
     */
    public function shuffle(
        SessionInterface $session
    ): Response
    {
        $deck = new \App\Card\Deck();
        $deck->shuffle();
        $session->set("deck", $deck);
        $data = [
            "title" => "Shuffle",
            "deckArr" => $deck->getDeck()
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{numberOfCards}", name="card-draw")
     */
    public function draw(
        Request $request,
        SessionInterface $session,
        int $numberOfCards = 1): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        $new  = $request->request->get('new');
        $amount = $request->request->get('amount');
        if ($amount) {
            $numberOfCards = $amount;
        }
        if ($new) {
            $deck->createDeck();
            $deck->shuffle();
        }
        if (($deck->getLength() - $numberOfCards) < 0) {
            $this->addFlash('info', 'Du kan inte dra så många kort.');
            $drawn = $session->get("drawn") ?? [];
        } else {
            $drawn = $deck->draw($numberOfCards);
            $session->set("deck", $deck);
        }
        $session->set("drawn", $drawn);
        $data = [
            "title" => "Draw",
            "deckArr" => $drawn,
            "amountLeft" => $deck->getLength()
            ];
        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="card-deal")
     */
    public function deal()
    {
    }
}
