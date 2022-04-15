<?php

namespace App\Controller;

use App\Client\QClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    #[Route(path: '/authors', name: 'authors_all')]
    public function authors(QClient $client): Response
    {
        return $this->render('dashboard/authors.html.twig', [
            'authors' => $client->getAuthors()
        ]);
    }

    #[Route(path: '/authors/{id}', name: 'authors_one')]
    public function author(int $id, QClient $client): Response
    {
        return $this->render('dashboard/author.html.twig', [
            'author' => $client->getAuthor($id)
        ]);
    }

    #[Route(path: '/authors/{id}/books', name: 'authors_books')]
    public function booksByAuthor(int $id, QClient $client): Response
    {
        return $this->render('dashboard/author.html.twig', [
            'author' => $client->getAuthor($id)
        ]);
    }
}