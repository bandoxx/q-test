<?php

namespace App\Controller;

use App\Client\QClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    #[Route(path: '/app/authors', name: 'app_authors')]
    public function authors(QClient $client)
    {
        return $this->render('dashboard/authors.html.twig', [
            'authors' => $client->getAuthors()
        ]);
    }

    #[Route(path: '/app/authors/{id}', name: 'app_author')]
    public function author(int $id, QClient $client)
    {
        return $this->render('dashboard/author.html.twig', [
            'author' => $client->getAuthor($id)
        ]);
    }
}