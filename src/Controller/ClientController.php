<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\Type\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route("/add-client", name="add-client")
     */
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = $form->getData();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('clients_list');
        }

        return $this->renderForm('client/new.html.twig', [
            'form' => $form,
        ]);

    }

    /**
     * @Route("/clients_list", name="clients_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $clients = $doctrine->getRepository(Client::class)->findAll();

        if (!$clients) {
            throw $this->createNotFoundException(
                'No clients found'
            );
        }

        return $this->render('client/list.html.twig', [
            'clients' => $clients
        ]);


    }

}