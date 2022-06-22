<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TabSeance;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class FrontseanceController extends Controller
{
    /**
     * @Route("/frontseance", name="app_frontseance")
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $TabSeance = $entityManager
            ->getRepository(TabSeance::class)
            ->findAll();
            $TabSeance = $this->get('knp_paginator')->paginate(
                // Doctrine Query, not results
                $TabSeance,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                2
            );

        return $this->render('frontseance/index.html.twig', [
            'TabSeances' => $TabSeance,
        ]);
    }
}
