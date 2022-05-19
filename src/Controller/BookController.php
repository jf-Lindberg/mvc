<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\CreateBookType;
use App\Repository\BookRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
     * @Route("/library/create", name="create_book")
     */
    public function createProduct(
        ManagerRegistry $doctrine
    ): Response {
        $book = new Book();

        $form = $this->createForm(CreateBookType::class, $book);

        return $this->renderForm('library/create.html.twig', [
            'form' => $form,
        ]);

////        $title = $request->request->get("title");
////        $isbn = $request->request->get("isbn");
////        $author = $request->request->get("author");
////        $image = $request->request->get("image");
//
////        $book = new Book();
////        $book->setTitle($title);
////        $book->setIsbn($isbn);
////        $book->setAuthor($author);
////        $book->setImage($image);
//
//        $entityManager = $doctrine->getManager();
//
//        // tell Doctrine you want to (eventually) save the Product
//        // (no queries yet)
//        $entityManager->persist($book);
//
//        // actually executes the queries (i.e. the INSERT query)
//        $entityManager->flush();
//
//        return new Response('Saved new product with id '.$book->getId());
    }
}

// Albert Camus - Främlingen - 9100223840 - stranger.jpg
// Franz Kafka - Processen - 9789177810193 - process.jpg
// Fjodor Dostojevskij - Brott och straff -  9789186745332 - crimeandpunishment.jpg
