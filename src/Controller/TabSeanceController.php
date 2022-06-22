<?php

namespace App\Controller;

use App\Entity\TabSeance;
use App\Form\TabSeanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;

/**
 * @Route("/tab/seance")
 */
class TabSeanceController extends AbstractController
{
    /**
     * @Route("/", name="app_tab_seance_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tabSeances = $entityManager
            ->getRepository(TabSeance::class)
            ->findAll();

        return $this->render('tab_seance/index.html.twig', [
            'tab_seances' => $tabSeances,
        ]);
    }

    /**
     * @Route("/new", name="app_tab_seance_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tabSeance = new TabSeance();
        $form = $this->createForm(TabSeanceType::class, $tabSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tabSeance);
            $entityManager->flush();

            
            $this->addFlash(
            'info','seance ajouté'
            );

            return $this->redirectToRoute('app_tab_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tab_seance/new.html.twig', [
            'tab_seance' => $tabSeance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSeance}", name="app_tab_seance_show", methods={"GET"})
     */
    public function show(TabSeance $tabSeance): Response

    {
        
        return $this->render('tab_seance/show.html.twig', [
            'tab_seance' => $tabSeance,
        ]);
    }

    

    /**
     * @Route("/{idSeance}/edit", name="app_tab_seance_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TabSeance $tabSeance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TabSeanceType::class, $tabSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'info','seance modifié'
                );
            return $this->redirectToRoute('app_tab_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tab_seance/edit.html.twig', [
            'tab_seance' => $tabSeance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSeance}", name="app_tab_seance_delete", methods={"POST"})
     */
    public function delete(Request $request, TabSeance $tabSeance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tabSeance->getIdSeance(), $request->request->get('_token'))) {
            $entityManager->remove($tabSeance);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_tab_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
