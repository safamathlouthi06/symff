<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
   public function listEvents(EventRepository $er): Response
    {
        $listEvents = $er->findAll();
        return $this->render('event/listEvents.html.twig',
            ['listeE' => $listEvents ]);
    }

    #[Route('/new', name: 'app_new')]
    public function new(Request $request, EntityManagerInterface $em) {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('app_event');
        }

        return $this->render('event/new.html.twig', [
            'formE' => $form->createView(),
        ]);
    }
    /*
    #[Route('/{id}', name: 'event_delete')]
    public function delete(EntityManagerInterface $em, EventRepository $er, $id) {
        $event = $er->find($id);
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('app_event');
    }*/
    #[Route('/{id}', name: 'event_delete')]
    public function delete(EntityManagerInterface $em, EventRepository $er, $id): Response {
        $event = $er->find($id);

        if (!$event) {
            return new Response('Event not found', Response::HTTP_NOT_FOUND);
        }

        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('app_event');
    }


    #[Route('/{id}/edit', name: 'event_update')]
    public function edit(Request $request, EntityManagerInterface $em, EventRepository $er, $id) {
        $event = $er->find($id);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('app_event');
        }

        return $this->render('event/edit.html.twig', [
            'formE' => $form->createView(),
        ]);
    }
    #[Route('/search', name: 'searchE')]
    public function searchEvent(Request $r, EntityManagerInterface $em) {
        $nom = $r->request->get('eventName');
        $q = $em->createQuery('select e from App\Entity\Event e where e.nom = :n');
        $q->setParameter('n', $nom);
        $events = $q->getResult();
        return $this->render('event/searchEvent.html.twig', [
            "listeE" => $events
        ]);
    }




}
