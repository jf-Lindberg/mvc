<?php

namespace App\Controller;

use Exception;
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
    ): Response {
        $deck = new \App\Card\Deck();
        $session->set("deck", $deck);
        $data = [
            "title" => "Deck",
            "deckArr" => $deck->getDeck()
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck2", name="card-deck-2")
     */
    public function deck2(
        SessionInterface $session
    ): Response {
        $deck = new \App\Card\Deck2();
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
    ): Response {
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        $deck->shuffle();
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
        int $numberOfCards = 1
    ): Response {
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        $new = $request->request->get('new');
        $amount = $request->request->get('amount') ?? $numberOfCards;

        if ($new) {
            $deck = new \App\Card\Deck();
            $deck->shuffle();
        }

        try {
            $drawn = $deck->draw($amount);
            $session->set("deck", $deck);
        } catch (Exception $e) {
            $this->addFlash('info', 'Du kan inte dra så många kort.');
            $drawn = $session->get("drawn") ?? [];
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
    public function deal(
        Request $request,
        SessionInterface $session,
        int $players = 2,
        int $cards = 5
    ): Response {
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        $new = $request->request->get('new');
        $playerArr = [];

        if ($new) {
            $deck = new \App\Card\Deck();
        }

        if (!$deck->isShuffled()) {
            $deck->shuffle();
        }

        try {
            for ($i = 1; $i <= $players; $i++) {
                $player = $playerArr[$i] ?? new \App\Card\Player($i, $deck);
                $player->dealHand($cards);
                $playerArr[$i] = [
                    "id" => $player->getId(),
                    "hand" => $player->getHand()
                ];
            }
        } catch (Exception $e) {
            $this->addFlash('info', 'Du kan inte dra så många kort.');
        }

        $session->set("deck", $deck);

        $data = [
            "title" => "Deal",
            "players" => $playerArr,
            "amountLeft" => $deck->getLength()
        ];

        return $this->render("card/deal.html.twig", $data);
    }
}
