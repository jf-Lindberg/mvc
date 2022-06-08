<?php

namespace App\Controller;

use App\Card\Bank;
use App\Card\BankDidNotStayException;
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
        Request $request,
        SessionInterface $session
    ): Response {
        $gameObject = $session->get("game");

        $bankData["hand"] = $gameObject->getBank()->getHand();
        $bankData["points"] = $gameObject->getBank()->getHandValue();

        $playerData["hand"] = $gameObject->getPlayer()->getHand();
        $playerData["points"] = $gameObject->getPlayer()->getHandValue();

        try {
            $winnerMessage = $gameObject->playerWins() ? "Banken drog " . $bankData["points"] .
                ". Du drog " . $playerData["points"] . ". Du vann!" : "Banken drog " . $bankData["points"] .
                ". Du drog " . $playerData["points"] . ". Du förlorade!";
            $this->addFlash('info', $winnerMessage);
        } catch (BankDidNotStayException $e) {
            $this->addFlash('info', '');
        }

        $data = [
            "title" => "Game",
            "playerData" => $playerData,
            "bankData" => $bankData
        ];
        return $this->render('game/game.html.twig', $data);
    }

    /**
     * @Route("/game/form", name="game-form")
     * @throws Exception
     */
    public function gameForm(
        Request $request,
        SessionInterface $session
    ): Response {
        $newGameRequest = $request->request->get('new');
        $stayRequest = $request->request->get('stay');
        $hitRequest = $request->request->get('hit');

        $gameObject = $session->get("game") ?? new Game(new Deck(), new Bank(), new Player(1));

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

        $session->set("game", $gameObject);

        return $this->redirectToRoute("game-play");
    }
}
