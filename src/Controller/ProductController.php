<?php

namespace App\Controller;


use App\Entity\Product;

use App\Form\Type\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/", name="add-product")
     */
    public function new(EntityManagerInterface $entityManager): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        if ($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products_list');
        }

        return $this->renderForm('product/new.html.twig', [
            'form' => $form,
        ]);

    }

    /**
     * @Route("/products_list", name="products_list")
     */
    public function list(): Response
    {

        return $this->render('product/list.html.twig');
    }



}