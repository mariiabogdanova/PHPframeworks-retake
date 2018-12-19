<?php

namespace App\Controller;

use App\Entity\ActiveMessage;
use App\Form\ActiveMessageType;
use App\Repository\ActiveMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/active/message")
 */
class ActiveMessageController extends AbstractController
{
    /**
     * @Route("/", name="active_message_index", methods={"GET"})
     */
    public function index(ActiveMessageRepository $activeMessageRepository): Response
    {
        return $this->render('active_message/index.html.twig', ['active_messages' => $activeMessageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="active_message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activeMessage = new ActiveMessage();
        $form = $this->createForm(ActiveMessageType::class, $activeMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activeMessage);
            $entityManager->flush();

            return $this->redirectToRoute('active_message_index');
        }

        return $this->render('active_message/new.html.twig', [
            'active_message' => $activeMessage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="active_message_show", methods={"GET"})
     */
    public function show(ActiveMessage $activeMessage): Response
    {
        return $this->render('active_message/show.html.twig', ['active_message' => $activeMessage]);
    }

    /**
     * @Route("/{id}/edit", name="active_message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActiveMessage $activeMessage): Response
    {
        $form = $this->createForm(ActiveMessageType::class, $activeMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('active_message_index', ['id' => $activeMessage->getId()]);
        }

        return $this->render('active_message/edit.html.twig', [
            'active_message' => $activeMessage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="active_message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActiveMessage $activeMessage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activeMessage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activeMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('active_message_index');
    }
}
