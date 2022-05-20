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
            'title' => 'Bibliotek',
        ]);
    }

    /**
     * @Route("/library/create", name="create_book")
     */
    public function createBook(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $book = new Book();

        // Please note that Symfony forms use POST by default
        $form = $this->createForm(CreateBookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            $entityManager = $doctrine->getManager();

            $entityManager->persist($book);
            $entityManager->flush();

            // ADD VIEW TO SHOW THE ID OF THE BOOK
            return $this->redirectToRoute('library_show_all');
        }

        $data = [
            'title' => 'Lägg till bok',
            'form' => $form,
        ];

        return $this->renderForm('library/create.html.twig', $data);
    }

    /**
     * @Route("/library/show", name="library_show_all")
     */
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $bookArr = [];
        foreach ($books as $book) {
            $obj = [
                "id" => $book->getId(),
                "title" => $book->getTitle(),
                "isbn" => $book->getIsbn(),
                "author" => $book->getAuthor(),
                "image" => $book->getImage()
            ];
            $bookArr[] = $obj;
        }

        $data = [
            "title" => "Bibliotek",
            "books" => $bookArr
        ];

        return $this->render('library/show-all.html.twig', $data);
    }

    /**
     * @Route("/library/show/{id}", name="library_by_id")
     */
    public function showBookById(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        $obj = [
            "id" => $book->getId(),
            "title" => $book->getTitle(),
            "isbn" => $book->getIsbn(),
            "author" => $book->getAuthor(),
            "image" => $book->getImage()
        ];

        $data = [
            "title" => "Bibliotek",
            "books" => [$obj]
        ];

        return $this->render('library/show-single.html.twig', $data);
    }

    /**
     * @Route("/library/update/{id}", name="library_update")
     */
    public function updateBook(
        Request $request,
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        // Please note that Symfony forms use POST by default
        $form = $this->createForm(CreateBookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            $entityManager = $doctrine->getManager();

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('library_show_all');
        }

        $data = [
            "title" => "Uppdatera bok",
            "form" => $form
        ];


        return $this->renderForm('library/update.html.twig', $data);
    }

    /**
     * @Route("/library/delete/{id}", name="library_delete_by_id")
     */
    public function deleteProductById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }
}
