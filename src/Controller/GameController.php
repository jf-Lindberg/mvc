<?php

namespace App\Controller;

use App\Card\Bank;
use App\Card\Deck;
use App\Card\Game;
use App\Card\Over21Exception;
use App\Card\Player;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game-home")
     */
    public function home(): Response
    {
        $data = [
            "title" => "Game"
        ];
        return $this->render('game/home.html.twig', $data);
    }

    /**
     * @Route("game/doc", name="game-docs")
     */
    public function doc(): Response
    {
        $finder = new Finder();
        $finder->files()->in("../doc")->name('*.md');
        $texts = [];
        foreach ($finder as $file) {
            $contents = $file->getContents();
            $texts[] = $contents;
        }

        $data = [
            "title" => "Game Documentation",
            'texts' => $texts
        ];
        return $this->render('game/docs.html.twig', $data);
    }

    /**
     * @Route("/game/play", name="game-play")
     * @throws Exception
     */
    public function game(
        Request          $request,
        SessionInterface $session
    ): Response {
        $newGameRequest = $request->request->get('new');
        $stayRequest = $request->request->get('stay');
        $hitRequest = $request->request->get('hit');

        $deckObject = new Deck();
        $bankObject = new Bank();
        $playerObject = new Player(1);
        $gameObject = $session->get("game") ?? new Game($deckObject, $bankObject, $playerObject);

        $playerData = [
            "hand" => [],
            "points" => 0
        ];

        $bankData = [
            "hand" => [],
            "points" => 0
        ];

        if ($newGameRequest) {
            $gameObject->newRound();
        };

        if ($gameObject->isRoundFinished()) {
            $this->addFlash('info', 'Spelet är över. Klicka "Nytt spel" för att spela igen.');
        }

        if ($hitRequest) {
            try {
                $gameObject->hitPlayer();
            } catch (Over21Exception $e) {
                $this->addFlash('info', 'Du drog över 21. Du har förlorat.');
            }
        }

        if ($stayRequest) {
            try {
                $gameObject->playBank();
            } catch (Over21Exception $e) {
                $this->addFlash('info', 'Banken drog över 21. Du har vunnit.');
            }
        }

        $bankData["hand"] = $gameObject->getBank()->getHand();
        $bankData["points"] = $gameObject->getBank()->getHandValue();

        $playerData["hand"] = $gameObject->getPlayer()->getHand();
        $playerData["points"] = $gameObject->getPlayer()->getHandValue();

        try {
            $winnerMessage = $gameObject->playerWins() ? "Banken drog " . $bankData["points"] .
                ". Du drog " . $playerData["points"] . ". Du vann!" : "Banken drog " . $bankData["points"] .
                ". Du drog " . $playerData["points"] . ". Du förlorade!";
            $this->addFlash('info', $winnerMessage);
        } catch (Exception $e) {
            $this->addFlash('info', '');
        }

        $session->set("game", $gameObject);

        $data = [
            "title" => "Game",
            "playerData" => $playerData,
            "bankData" => $bankData
        ];
        return $this->render('game/game.html.twig', $data);
    }

//    /**
//     * @Route("/game/play", name="game-play")
//     * @throws Exception
//     */
//    public function game(
//        Request          $request,
//        SessionInterface $session
//    ): Response {
////        $newGameRequest = $request->request->get('new');
////        $stayRequest = $request->request->get('stay');
////        $hitRequest = $request->request->get('hit');
////
////        $deckObject = new Deck();
////        $bankObject = new Bank();
////        $playerObject = new Player();
////        $gameObject = $session->get("game") ?? new Game($deckObject, $bankObject, $playerObject);
////
////        if ($newGameRequest) {
////            $session->remove("deck");
////            $session->remove("bank");
////            $session->remove("player");
////            $session->remove("game");
////        };
////
////        $deckObject = $session->get("deck") ?? new Deck();
////        $bankObject = $session->get("bank") ?? new Bank();
////        $playerObject = $session->get("player") ?? new Player(1);
////        $gameObject = $session->get("game") ?? new Game($deckObject, $bankObject, $playerObject);
////
////        if (!$deckObject->isShuffled()) {
////            $deckObject->shuffle();
////        }
////
////        if ($gameObject->isRoundFinished()) {
////            $this->addFlash('info', 'Spelet är över. Klicka "Nytt spel" för att spela igen.');
////        }
////
////        if (($hitRequest && !$gameObject->isRoundFinished()) || $newGameRequest || !$session->has("game")) {
////            try {
////                $gameObject->hitPlayer();
////            } catch (Exception $e) {
////                $this->addFlash('info', 'Du drog över 21. Du har förlorat.');
////            }
////        }
////
////        $bankStays = false;
////        $bankData = [
////            "hand" => [],
////            "points" => 0
////        ];
////        if ($stayRequest && !$gameObject->isRoundFinished()) {
////            try {
////                while ($bankObject->decidesToHit()) {
////                    $gameObject->hitBank();
////                }
////                $bankStays = true;
////            } catch (Exception $e) {
////                $this->addFlash('info', 'Banken drog över 21. Du har vunnit.');
////                $session->remove("deck");
////            }
////        }
////
////        $bankData["hand"] = $bankObject->getHand();
////        $bankData["points"] = $bankObject->getHandValue();
////
////        $playerData = [
////            "hand" => $playerObject->getHand(),
////            "points" => $playerObject->getHandValue()
////        ];
////
////        if ($bankStays) {
////            if ($gameObject->playerWins()) {
////                $this->addFlash(
////                    'info',
////                    "Banken drog " . $bankData["points"] .
////                    ". Du drog " . $playerData["points"] . ". Du vann!"
////                );
////            } else {
////                $this->addFlash(
////                    'info',
////                    $this->addFlash(
////                        'info',
////                        "Banken drog " . $bankData["points"] .
////                        ". Du drog " . $playerData["points"] . ". Du förlorade!"
////                    )
////                );
////            }
////        }
////
////        $session->set("game", $gameObject);
////        $session->set("player", $playerObject);
////        $session->set("bank", $bankObject);
////        $session->set("deck", $deckObject);
////
////        $data = [
////            "title" => "Game",
////            "playerData" => $playerData,
////            "bankData" => $bankData
////        ];
////        return $this->render('game/game.html.twig', $data);
//    }
}
