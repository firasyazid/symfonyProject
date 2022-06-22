<?php

namespace App\Controller;

  
use App\Entity\Produit;
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

class MobileProduitController extends AbstractController
{

        ////////////////////////////////////////////::Jason for CodeNameOne::////////////////////////////////////////////

        /**
     * @Route("/addProduit", name="add_Produit")
     * @Method("POST")
     */
    public function ajouterProduit(Request $request)
    {
        $produit = new Produit();

        $produit->setDescription($request->query->get("description"));
        $produit->setName($request->query->get("name"));
        $produit->setPrice($request->query->get("price"));
        $produit->setIdcategorie($request->query->get("idCategorie"));
        $produit->setImage($request->query->get("image"));


        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($produit);
        return new JsonResponse($formatted);

}
/**
     * @Route("/AfficherProduits", name="AfficherProduits")
     */
    public function AffichageProduits( NormalizerInterface  $normalizer)
    {
        $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findAll();
         $serializer=new Serializer ([new ObjectNormalizer()]);
         $formatted = $serializer->normalize($produit);

            return new JsonResponse($formatted);
    }

/**
     * @Route("/SupprimerProduits", name="SupprimerProduits")
     * @Method("DELETE")
     */
    public function SupprimerProduits(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        if($produit != null)
        {
            $em->remove($produit);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formated = $serializer->normalize("Produit ete supprimer avec succées ");
            return new JsonResponse($formated);

        }
        return new JsonResponse("id produit est invalide !");
    }
/**
     * @Route("/updateProduit", name="update_activite")
     * @Method("PUT")
     */
    public function modifierProduit(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $Produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find($request->get("id"));

        $Produit->setName($request->query->get("name"));
        $Produit->setDescription($request->query->get("description"));
 
        $Produit->setPrice($request->query->get("price"));
         $Produit->setImage($request->query->get("image"));;

        $em->persist($Produit);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Produit);
        return new JsonResponse("Produit a ete modifiee avec success.");

    }

     /**
      * @Route("/detailProduit", name="detail_reclamation")
      * @Method("GET")
      */

      public function detailProduit(Request $request)
     {
         $id = $request->get("id");

         $em = $this->getDoctrine()->getManager();
         $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find($id);
         $encoder = new JsonEncoder();
         $normalizer = new ObjectNormalizer();
         $normalizer->setCircularReferenceHandler(function ($object) {
             return $object->getDescription();
         });
         $serializer = new Serializer([$normalizer], [$encoder]);
         $formatted = $serializer->normalize($reclamation);
         return new JsonResponse($formatted);
     }

}