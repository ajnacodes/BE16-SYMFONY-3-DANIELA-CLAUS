<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\Todo1Type;
use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo/crud')]
class TodoCrudController extends AbstractController
{
    #[Route('/', name: 'app_todo_crud_index', methods: ['GET'])]
    public function index(TodoRepository $todoRepository): Response
    {
        return $this->render('todo_crud/index.html.twig', [
            'todos' => $todoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_todo_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TodoRepository $todoRepository): Response
    {
        $todo = new Todo();
        $form = $this->createForm(Todo1Type::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todoRepository->add($todo, true);

            return $this->redirectToRoute('app_todo_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todo_crud/new.html.twig', [
            'todo' => $todo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_todo_crud_show', methods: ['GET'])]
    public function show(Todo $todo): Response
    {
        return $this->render('todo_crud/show.html.twig', [
            'todo' => $todo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_todo_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Todo $todo, TodoRepository $todoRepository): Response
    {
        $form = $this->createForm(Todo1Type::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todoRepository->add($todo, true);

            return $this->redirectToRoute('app_todo_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todo_crud/edit.html.twig', [
            'todo' => $todo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_todo_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Todo $todo, TodoRepository $todoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todo->getId(), $request->request->get('_token'))) {
            $todoRepository->remove($todo, true);
        }

        return $this->redirectToRoute('app_todo_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
