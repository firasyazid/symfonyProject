<?php

namespace App\Controller;

  
use App\Entity\Client;
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

class MobileClientController extends AbstractController
{

        ////////////////////////////////////////////::Jason for CodeNameOne::////////////////////////////////////////////

        /**
     * @Route("/addClient", name="add_Client")
     * @Method("POST")
     */
    public function ajouterClientAction(Request $request)
    {
        $Client = new Client();

        $Client->setNom($request->query->get("nom"));
        $Client->setPrenom($request->query->get("prenom"));
        $Client->setAdresse($request->query->get("adresse"));
        $Client->setMail($request->query->get("mail"));
        $Client->setMdpClient($request->query->get("mdpClient"));


        $em = $this->getDoctrine()->getManager();
        $em->persist($Client);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Client);
        return new JsonResponse($formatted);

}
/**
     * @Route("/AfficherClients", name="AffichageClients")
     */
    public function AffichageClients( NormalizerInterface  $normalizer)
    {
        $Client = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Client);

        return new JsonResponse($formatted);
    }

/**
     * @Route("/SupprimerClients", name="SupprimerClients")
     * @Method("DELETE")
     */
    public function SupprimerClients(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $Client = $em->getRepository(Client::class)->find($id);
        if($Client != null)
        {
            $em->remove($Client);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formated = $serializer->normalize("Client ete supprimer avec succées ");
            return new JsonResponse($formated);

        }
        return new JsonResponse("id Client est invalide !");
    }
/**
     * @Route("/updateClient", name="update_client")
     * @Method("PUT")
     */
    public function modifierClient(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $Client = $this->getDoctrine()->getManager()->getRepository(Client::class)->find($request->get("id"));

        $Client->setNom($request->query->get("nom"));
        $Client->setPrenom($request->query->get("prenom"));
 
        $Client->setAdresse($request->query->get("adresse"));
        $Client->setMail($request->query->get("mail"));
        $Client->setMdpClient($request->query->get("mdpClient"));;

        $em->persist($Client);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Client);
        return new JsonResponse("Client a ete modifiee avec success.");

    }

}