<?php

namespace App\Controller;

use App\Entity\TabCoach;
use App\Form\TabCoachType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tab/coach")
 */
class TabCoachController extends AbstractController
{
    /**
     * @Route("/", name="app_tab_coach_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tabCoaches = $entityManager
            ->getRepository(TabCoach::class)
            ->findAll();

        return $this->render('tab_coach/index.html.twig', [
            'tab_coaches' => $tabCoaches,
        ]);
    }

    /**
     * @Route("/new", name="app_tab_coach_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tabCoach = new TabCoach();
        $form = $this->createForm(TabCoachType::class, $tabCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tabCoach);
            $entityManager->flush();
            $this->addFlash(
                'info','coach ajouté'
                );
            return $this->redirectToRoute('app_tab_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tab_coach/new.html.twig', [
            'tab_coach' => $tabCoach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCoach}", name="app_tab_coach_show", methods={"GET"})
     */
    public function show(TabCoach $tabCoach): Response
    {
        return $this->render('tab_coach/show.html.twig', [
            'tab_coach' => $tabCoach,
        ]);
    }

    /**
     * @Route("/{idCoach}/edit", name="app_tab_coach_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TabCoach $tabCoach, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TabCoachType::class, $tabCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'info','coach modifié'
                );

            return $this->redirectToRoute('app_tab_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tab_coach/edit.html.twig', [
            'tab_coach' => $tabCoach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCoach}", name="app_tab_coach_delete", methods={"POST"})
     */
    public function delete(Request $request, TabCoach $tabCoach, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tabCoach->getIdCoach(), $request->request->get('_token'))) {
            $entityManager->remove($tabCoach);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tab_coach_index', [], Response::HTTP_SEE_OTHER);
    }
}
