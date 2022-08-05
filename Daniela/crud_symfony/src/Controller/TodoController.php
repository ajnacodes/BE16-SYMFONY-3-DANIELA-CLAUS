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
            'controller_name' => 'TodoController',
        ]);
    }


    #[Route('/create', name: 'app_todo_create')]
    public function create(): Response
    {
        return $this->render('todo/create.html.twig');
    }
  
    #[Route('/edit/{id}', name: 'app_todo_edit')]
    public function edit($id): Response
    {
        return $this->render('todo/edit.html.twig');
    }
  
    #[Route('/details/{id}', name: 'app_todo_details')]
    public function details($id): Response
    {
        return $this->render('todo/details.html.twig');
    }
}
