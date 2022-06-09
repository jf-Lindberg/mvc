<?php

namespace App\Controller;

use App\Card\Deck;
use App\Card\NotEnoughCardsException;
use App\Card\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardJSONController extends AbstractController
{

    public function createResponse(Array $data): JsonResponse
    {
        return new JsonResponse($data);
    }

    /**
     * @Route("card/api/deck", name="api-deck")
     */
    public function apiDeck(
        SessionInterface $session
    ): Response {
        $deck = new Deck();
        $data = [
            "deck" => $deck->jsonify()
        ];
        $session->set("deck", $deck);

        return $this->createResponse($data);
    }

    /**
     * @Route("card/api/deck/shuffle", name="api-shuffle")
     */
    public function apiShuffle(): Response
    {
        $deck = new Deck();
        $deck->shuffle();
        $data = [
            "deck" => $deck->jsonify()
        ];

        return $this->createResponse($data);
    }

    /**
     * @Route("card/api/deck/draw/{numberOfCards}", name="api-draw")
     */
    public function apiDraw(
        SessionInterface $session,
        int $numberOfCards = 1
    ): Response {
        $deck = $session->get("deck") ?? new Deck();
        $status = 'success';

        try {
            $drawn = $deck->draw($numberOfCards);
            $session->set("deck", $deck);
        } catch (NotEnoughCardsException $e) {
            $drawn = $session->get("drawn") ?? [];
            $status = 'failed';
        }

        $session->set("drawn", $drawn);
        $drawnJson = [];
        foreach ($drawn as $card) {
            $drawnJson[] = $card->jsonify();
        }
        $data = [
            "drawn cards" => $drawnJson,
            "cards left" => $deck->getLength(),
            "fetch" => $status
        ];

        return $this->createResponse($data);
    }

    /**
     * @Route("card/api/deck/deal/{amountOfPlayers}/{amountOfCards}", name="api-deal")
     */
    public function apiDeal(
        SessionInterface $session,
        int $amountOfPlayers = 3,
        int $amountOfCards = 4
    ): Response {
        $deck = $session->get("deck") ?? new Deck();
        $arrayOfPlayers = [];
        $status = 'success';

        if (!$deck->isShuffled()) {
            $deck->shuffle();
        }

        try {
            for ($id = 1; $id <= $amountOfPlayers; $id++) {
                $player = new Player($id);
                $hand = $deck->draw($amountOfCards);
                $player->addCardsToHand($hand);
                $arrayOfPlayers[$id] = [
                    "id" => $player->getIdent(),
                    "hand" => $player->getJsonHand()
                ];
            }
        } catch (NotEnoughCardsException $e) {
            $status = 'failed';
        }

        $session->set("deck", $deck);

        $data = [
            "players" => $arrayOfPlayers,
            "cards left" => $deck->getLength(),
            "fetch" => $status
        ];

        return $this->createResponse($data);
    }
}
