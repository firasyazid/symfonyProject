<?php

namespace App\Controller;

  
use App\Entity\Abonnement;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Json;
use Doctrine\ORM\EntityManagerInterface;

class MobileAbonnementController extends AbstractController
{

        ////////////////////////////////////////////::Jason for CodeNameOne::////////////////////////////////////////////

        /**
     * @Route("/addAbonnement", name="add_Abonnement")
     * @Method("POST")
     */
    public function ajouterAbonnement(Request $request)
    {
        $Abonnement = new Abonnement();

        $Abonnement->setNomAb($request->query->get("nomAb"));
        $Abonnement->setPrixAb($request->query->get("prixAb"));
        $Abonnement->setDescription($request->query->get("description"));


        $em = $this->getDoctrine()->getManager();
        $em->persist($Abonnement);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Abonnement);
        return new JsonResponse($formatted);

}
/**
     * @Route("/AfficherAbonnements", name="Affichageabn")
     */
    public function AffichageAbonnements( NormalizerInterface  $normalizer)
    {
        $Abonnement = $this->getDoctrine()->getRepository(Abonnement::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Abonnement);

        return new JsonResponse($formatted);
    }

/**
     * @Route("/SupprimerAbonnements", name="SupprimerAbonnements")
     * @Method("DELETE")
     */
    public function SupprimerAbonnements(Request $request)
    {
        $idAbonnement = $request->get("idAbonnement");
        $em = $this->getDoctrine()->getManager();
        $Abonnement = $em->getRepository(Abonnement::class)->find($idAbonnement);
        if($Abonnement != null)
        {
            $em->remove($Abonnement);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formated = $serializer->normalize("Abonnement ete supprimer avec succées ");
            return new JsonResponse($formated);

        }
        return new JsonResponse("id Abonnement est invalide !");
    }
/**
     * @Route("/updateAbonnement", name="update_activite")
     * @Method("PUT")
     */
    public function modifierAbonnement(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $Abonnement = $this->getDoctrine()->getManager()->getRepository(Abonnement::class)->find($request->get("id"));

        $Abonnement->setIdAbonnement($request->query->get("idAbonnement"));
        $Abonnement->setNomAb($request->query->get("nomAb"));
        $Abonnement->setPrixAb($request->query->get("prixAb"));
        $Abonnement->setDescription($request->query->get("description"));;

        $em->persist($Abonnement);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Abonnement);
        return new JsonResponse("Abonnement a ete modifiee avec success.");

    }

}