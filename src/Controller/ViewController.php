<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Form\ProduitType;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Component\HttpFoundation\Request; 
use App\Entity\Abonnement;


class ViewController extends AbstractController
{
    /**
     * @Route("/view", name="app_view")
     */
    public function index(): Response
    {
        return $this->render('Front/index.html.twig', [
            'controller_name' => 'ViewController',
        ]);
    }

    /**
     * @Route("/dashboard", name="display_Dashboard")
     */
    public function indexDashboard(): Response
    {
        return $this->render('Back/index.html.twig');
    }

        /**
     * @Route("/music", name="music_player")
     */
    public function music_player(): Response
    {
        return $this->render('Back/music.html.twig');
    }

    
        /**
     * @Route("/seance", name="seance")
     */
    public function seance_view(): Response
    {
        return $this->render('tab_seance/seance_front.html.twig');
    }
    
    /**
     * @Route("/front", name="display_front")
     */
    public function indexfront(): Response
    {
        return $this->render('base.html.twig');
    }

        /**
     * @Route("/imc", name="imc_calculator")
     */
    public function imc(): Response
    {
        return $this->render('client/imc.html.twig');
    }

    /**
     * @Route("/map", name="map")
     */
    public function map(): Response
    {
        return $this->render('Map/maps.html.twig');
    }

    /**
     * @Route("/Abonnement_Front", name="Abonnement_Front")
     */
    public function Abonnement_Front(EntityManagerInterface $entityManager,PaginatorInterface $paginator,Request $request): Response
    {
        $donnees = $entityManager
            ->getRepository(Abonnement::class)
            ->findAll();

            $abonnements = $paginator->paginate(
                $donnees, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                4// Nombre de résultats par page
            );
    
         return $this->render('abonnement/abonnement_front.html.twig', [
            'abonnements' => $abonnements
        ]);
    }



/**
     * @Route("/prd", name="app_produit_view", methods={"GET"})
     */
    public function indexView(EntityManagerInterface $entityManager,PaginatorInterface $paginator,Request $request): Response
    {


        $donnees = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

            $produits = $paginator->paginate(
                $donnees,  
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                3// Nombre de résultats par page
            );
    
         return $this->render('product/index.html.twig', [
            'produits' => $produits
        ]);


    }
/**
     * @Route("/panier", name="panier_display")
     */
    public function indexCart(): Response
    {
        return $this->render('panier/index.html.twig');
    }


}
