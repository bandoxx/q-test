<?php

namespace App\Controller;

use App\Client\QClient;
use App\Form\BookType;
use App\Model\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route(path: '/books/new', name: 'book_insert', methods: 'POST|GET')]
    public function newBook(QClient $client, Request $request): RedirectResponse|Response
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            $client->insertBook($book);
            $this->addFlash('success', 'Book successfully inserted!');

            return $this->redirectToRoute('book_insert');
        }

        return $this->renderForm('dashboard/book.html.twig', [
            'form' => $form
        ]);
    }
}