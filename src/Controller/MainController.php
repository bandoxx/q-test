<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route(path: '/app/dashboard', name: 'app_dashboard')]
    public function homepage()
    {
        return $this->render('dashboard/main.html.twig');
    }

}