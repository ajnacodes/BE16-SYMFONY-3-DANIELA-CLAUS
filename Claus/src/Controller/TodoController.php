<?php

namespace App\Controller;

use App\Entity\Todo;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\TodoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $todos = $doctrine->getRepository(Todo::class)->findAll();
        // dd($todos);
        return $this->render('todo/index.html.twig', [
            "todos" => $todos
        ]);
    }

    #[Route('/create', name: 'app_todo_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $now = new \DateTime("now");
            $todo = $form->getData();
            $todo->setCreateDate($now);
            $em = $doctrine->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash("notice", "Todo has been added");
            return $this->redirectToRoute("app_todo");
        }

        
        return $this->render('todo/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'app_todo_edit')]
    public function edit($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $todo = $doctrine->getRepository(Todo::class)->find($id);
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $todo = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($todo);
            $em->flush();

            $this->addFlash("notice", "Todo has been updated");
            return $this->redirectToRoute("app_todo");
        }

        return $this->render('todo/edit.html.twig', [
            "form" => $form->createView()
            
        ]);
    }


    #[Route('/details/{id}', name: 'app_todo_details')]
    public function details($id, ManagerRegistry $doctrine): Response
    {
        $todo = $doctrine->getRepository(Todo::class)->find($id);

        return $this->render('todo/details.html.twig', [
            "todo" => $todo
        ]);
    }

    #[Route('/delete/{id}', name: 'app_todo_delete')]
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $todo = $doctrine->getRepository(Todo::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($todo);
        $em->flush();
        $this->addFlash("notice", "Todo has been deleted");
        return $this->redirectToRoute("app_todo");
    
    }
}
