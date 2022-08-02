<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(): Response
    {
        return $this->render('todo/index.html.twig', [
            
        ]);
    }

    #[Route('/create', name: 'app_todo_create')]
    public function create(): Response
    {
        return $this->render('todo/create.html.twig', [
            
        ]);
    }

    // #[Route('/', name: 'app_todo')]
    // public function index(): Response
    // {
    //     return $this->render('todo/index.html.twig', [
            
    //     ]);
    // }

    // #[Route('/', name: 'app_todo')]
    // public function index(): Response
    // {
    //     return $this->render('todo/index.html.twig', [
            
    //     ]);
    // }
}
