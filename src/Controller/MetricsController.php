<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    /**
     * @Route("/metrics", name="metrics-home")
     */
    public function home(): Response
    {
        $finder = new Finder();
        $finder->files()->in("../texter/metrics")->name('*.md')->sortByName(true);
        $texts = [];
        foreach ($finder as $file) {
            $contents = $file->getContents();
            $texts[] = $contents;
        }

        $data = [
            "title" => "Metrics",
            'texts' => $texts
        ];
        return $this->render('metrics/home.html.twig', $data);
    }
}
