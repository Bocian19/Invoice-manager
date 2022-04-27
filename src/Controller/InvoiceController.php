<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\Type\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route("/add-invoice", name="add-invoice")
     */
    public function newInvoice(EntityManagerInterface $entityManager, Request $request): Response
    {
        $invoice = new Invoice();

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $invoice = $form->getData();
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('invoice_list');
        }

        return $this->renderForm('invoice/new.html.twig', [
            'form' => $form,
        ]);

    }

    /**
     * @Route("/invoice_list", name="invoice_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $invoices = $doctrine->getRepository(Invoice::class)->findAll();

        if (!$invoices) {
            throw $this->createNotFoundException(
                'No invoices found'
            );
        }

        return $this->render('invoice/list.html.twig', [
            'invoices' => $invoices
        ]);


    }

}