<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class PresentationControllerTwig extends AbstractController
{
    /**
     * @Route("/", name="presentation")
     */
    public function presentation(): Response
    {
        $name = 'Filip';

        return $this->render('presentation.html.twig', [
            'name' => $name,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        $course = 'MVC';

        return $this->render('about.html.twig', [
            'course' => $course,
        ]);
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        /**
         * Gathers all presentation texts and renders report template with them.
         *
         * @return array with texts
         */
        $finder = new Finder();
        $finder->files()->in("../texter")->name('*.md');

        $texts = [];
        foreach ($finder as $file) {
            $contents = $file->getContents();
            array_push($texts, $contents);
        }

        return $this->render('report.html.twig', [
            'texts' => $texts,
        ]);
    }
}
