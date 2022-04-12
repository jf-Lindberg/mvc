<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardJSONController extends AbstractController
{
    /**
     * @Route("card/api/deck", name="api-deck")
     */
    public function apiDeck(
        SessionInterface $session
    ): Response
    {
        $deck = new \App\Card\Deck();
        $data = [
            "deck" => $deck->getDeck()
        ];
        $session->set("deck", $deck);

        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck/shuffle", name="api-shuffle")
     */
    public function apiShuffle(): Response
    {
        $deck = new \App\Card\Deck();
        $deck->shuffle();
        $data = [
            "deck" => $deck->getDeck()
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck/draw/{numberOfCards}", name="api-draw")
     */
    public function apiDraw(
        SessionInterface $session,
        int              $numberOfCards = 1
    ): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck();

        try {
            $drawn = $deck->draw($numberOfCards);
            $session->set("deck", $deck);
        } catch (Exception $e) {
            $drawn = $session->get("drawn") ?? [];
        }

        $session->set("drawn", $drawn);
        $data = [
            "drawn cards" => $drawn,
            "cards left" => $deck->getLength()
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck/deal/{players}/{cards}", name="api-deal")
     */
    public function apiDeal(
        SessionInterface $session,
        int              $players = 3,
        int              $cards = 4
    ): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        $playerArr = [];

        if (!$deck->isShuffled()) {
            $deck->shuffle();
        }

        try {
            for ($i = 1; $i <= $players; $i++) {
                $player = $playerArr["Player " . $i] ??new \App\Card\Player($i, $deck);
                $player->dealHand($cards);
                $playerArr[$i] = [
                    "id" => $player->getId(),
                    "hand" => $player->getHand()
                ];
            }
        } catch (Exception $e)
        {
        }

        $session->set("deck", $deck);

        $data = [
            "players" => $playerArr,
            "cards left" => $deck->getLength()
        ];

        return new JsonResponse($data);
    }
}
