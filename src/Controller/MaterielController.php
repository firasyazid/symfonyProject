<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\MaterielRepository;
use App\Entity\Urlizer;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/materiel")
 */
class MaterielController extends AbstractController
{
    /**
     * @Route("/", name="app_materiel_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $materiels = $entityManager
            ->getRepository(Materiel::class)
            ->findAll();

        return $this->render('materiel/index.html.twig', [
            'materiels' => $materiels,
        ]);
    }
    /**
     * @Route("/affichage", name="app_materiel_affichage", methods={"GET"})
     */
    public function affichage(EntityManagerInterface $entityManager ,Request $request,PaginatorInterface $paginator): Response
    {
        $materiels = $entityManager
            ->getRepository(Materiel::class)
            ->findAll();
        $materiels = $paginator->paginate(
            $materiels, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2/*limit per page*/);
        // select * from product

        return $this->render('materiel/front.html.twig', [
            'materiels' => $materiels,
        ]);
    }



    /**
     * @Route("/new", name="app_materiel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materiel = new Materiel();
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image']->getData();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );
            $materiel->setImage($newFilename);



            $entityManager->persist($materiel);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'votre materiel s est ajouter !!',
          );

            return $this->redirectToRoute('app_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materiel/new.html.twig', [
            'materiel' => $materiel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_materiel_show", methods={"GET"})
     */
    public function show(Materiel $materiel): Response
    {
        return $this->render('materiel/show.html.twig', [
            'materiel' => $materiel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_materiel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();
            $this->addFlash(
                'info',
                'votre materiel s est modifier !!'
          );
            return $this->redirectToRoute('app_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_materiel_delete", methods={"POST"})
     */
    public function delete(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($materiel);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'votre materiel a ete supprimer !!',
          );
        }

        return $this->redirectToRoute('app_materiel_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/pdf/{id}", name="app_materiel_pdf", requirements={"id"="\d+"})
     */

    public function list(MaterielRepository $materielRepository, Request $request): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $Materiel=$materielRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('materiel/pdf.html.twig', [
            'Materiel' => $Materiel,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A3', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Materiel.pdf", [
            "Attachment" => false
        ]);

    }

}