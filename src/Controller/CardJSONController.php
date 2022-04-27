<?php

namespace App\Controller;

use App\Card\Deck;
use App\Card\Player;
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
    ): Response {
        $deck = new Deck();
        $data = [
            "deck" => $deck->getJsonDeck()
        ];
        $session->set("deck", $deck);

        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck/shuffle", name="api-shuffle")
     */
    public function apiShuffle(): Response
    {
        $deck = new Deck();
        $deck->shuffle();
        $data = [
            "deck" => $deck->getJsonDeck()
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck/draw/{numberOfCards}", name="api-draw")
     */
    public function apiDraw(
        SessionInterface $session,
        int $numberOfCards = 1
    ): Response {
        $deck = $session->get("deck") ?? new Deck();

        try {
            $drawn = $deck->draw($numberOfCards);
            $session->set("deck", $deck);
        } catch (Exception $e) {
            $drawn = $session->get("drawn") ?? [];
        }

        $session->set("drawn", $drawn);
        $drawnJson = [];
        foreach ($drawn as $card) {
            $drawnJson[] = $card->getJsonCard();
        }
        $data = [
            "drawn cards" => $drawnJson,
            "cards left" => $deck->getLength()
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck/deal/{players}/{cards}", name="api-deal")
     */
    public function apiDeal(
        SessionInterface $session,
        int $players = 3,
        int $cards = 4
    ): Response {
        $deck = $session->get("deck") ?? new Deck();
        $playerArr = [];

        if (!$deck->isShuffled()) {
            $deck->shuffle();
        }

        try {
            for ($i = 1; $i <= $players; $i++) {
                $player = new Player($i, $deck);
                $player->dealHand($cards);
                $playerArr[$i] = [
                    "id" => $player->getPlayerId(),
                    "hand" => $player->getJsonHand()
                ];
/*                $player = new Player($i, $deck);
                $playerId = $player->getPlayerId();
                $player->dealHand($cards);
                $playerHand = $player->getHand();
                $playerArr[$i] = [
                    "id" => $player->$playerId,
                    "hand" => $player->$playerHand
                ];*/
            }
        } catch (Exception $e) {
            echo $e;
        }

        $session->set("deck", $deck);

        $data = [
            "players" => $playerArr,
            "cards left" => $deck->getLength()
        ];

        return new JsonResponse($data);
    }
}
