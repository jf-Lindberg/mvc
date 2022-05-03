<?php

namespace App\Controller;

use App\Card\Deck;
use App\Card\Deck2;
use App\Card\newDeck;
use App\Card\Player;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class newCardGameController extends AbstractController
{
    /**
     * @Route("/card/newdeck", name="card-newdeck")
     */
    public function deck(
        SessionInterface $session
    ): Response {
        $deckObject = $session->get("deck") ?? new newDeck();
        $deck = $deckObject->getDeck();
        $data = [
            "title" => "Deck",
            "deck" => $deck
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/newdeck/shuffle", name="card-newdeck-shuffle")
     */
    public function shuffle(
        SessionInterface $session
    ): Response {
        $deckObject = $session->get("deck") ?? new newDeck();
        $deckObject->shuffle();
        $deck = $deckObject->getDeck();
        $data = [
            "title" => "Deck",
            "deck" => $deck
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/newdeck/draw/{numberOfCards}", name="card-newdeck-draw")
     */
    public function draw(
        Request $request,
        SessionInterface $session,
        int $numberOfCards = 1
    ): Response {
        $deck = $session->get("deck") ?? new newDeck();
        $new = $request->request->get('new');
        $amount = $request->request->get('amount') ?? $numberOfCards;

        if ($new) {
            $deck = new newDeck();
            $deck->shuffle();
        }

        try {
            if ($amount > $deck->getLength()) {
                throw new Exception('Not enough cards');
            }
            for ($i = 0; $i < $amount; $i++) {
                $drawn[] = $deck->deal();
            }
            $session->set("deck", $deck);
        } catch (Exception $e) {
            $this->addFlash('info', 'Du kan inte dra så många kort.');
            $drawn = $session->get("drawn") ?? [];
        }

        $session->set("drawn", $drawn);

        $data = [
            "title" => "Draw",
            "deck" => $drawn,
            "amountLeft" => $deck->getLength()
        ];
        return $this->render('card/draw.html.twig', $data);
    }
}
