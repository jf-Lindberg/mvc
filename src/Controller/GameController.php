<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function game(): Response
    {
        $data = [
            "title" => "Game"
        ];
        return $this->render('game/game.html.twig', $data);
    }

    /**
     * @Route("/game/doc", name="game-doc")
     */
    public function gameDoc(): Response
    {
        $data = [
            "title" => "Game Documentation"
        ];
        return $this->render('game/game-doc.html.twig', $data);
    }
}
