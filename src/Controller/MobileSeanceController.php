<?php

namespace App\Controller;

  
use App\Entity\TabSeance;
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

class MobileSeanceController extends AbstractController
{

        ////////////////////////////////////////////::Jason for CodeNameOne::////////////////////////////////////////////

        /**
     * @Route("/addTabSeance", name="add_TabSeance")
     * @Method("POST")
     */
    public function ajouterSeanceAction(Request $request)
    {
        $tabSeance = new TabSeance();

        $tabSeance->setTypeSeance($request->query->get("typeSeance"));
        $tabSeance->setDateDebut($request->query->get("dateDebut"));
        $tabSeance->setDateFin($request->query->get("dateFin"));
        $tabSeance->setIdCoach($request->query->get("idCoach"));


        $em = $this->getDoctrine()->getManager();
        $em->persist($tabSeance);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tabSeance);
        return new JsonResponse($formatted);

}
/**
     * @Route("/AfficherTabSeances", name="Affichagesnc")
     */
    public function AffichageTabSeances( NormalizerInterface  $normalizer)
    {
        $tabSeance = $this->getDoctrine()->getRepository(TabSeance::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tabSeance);

        return new JsonResponse($formatted);
    }

/**
     * @Route("/SupprimerTabSeances", name="SupprimerTabSeances")
     * @Method("DELETE")
     */
    public function SupprimerTabSeances(Request $request)
    {
        $idSeance = $request->get("idSeance");
        $em = $this->getDoctrine()->getManager();
        $tabSeance = $em->getRepository(tabSeance::class)->find($idSeance);
        if($tabSeance != null)
        {
            $em->remove($tabSeance);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formated = $serializer->normalize("seanace ete supprimer avec succées ");
            return new JsonResponse($formated);

        }
        return new JsonResponse("id seance est invalide !");
    }
/**
     * @Route("/updateTabSeance", name="update_TabSeance")
     * @Method("PUT")
     */
    public function modifierTabSeances(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $TabSeance = $this->getDoctrine()->getManager()->getRepository(tabSeance::class)->find($request->get("idSeance"));

        $TabSeance->setTypeSeance($request->query->get("typeSeance"));
        $TabSeance->setDateDebut($request->query->get("dateDebut"));
        $TabSeance->setDateFin($request->query->get("dateFin"));
        
        $em->persist($TabSeance);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($TabSeance);
        return new JsonResponse("seance a ete modifiee avec success.");

    }

}