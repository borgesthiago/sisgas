<?php

namespace App\Controller;

use App\Entity\Documento;
use App\Entity\StatusDocumento;
use App\Form\StatusDocumentoType;
use App\Repository\StatusRepository;
use App\Repository\StatusDocumentoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/status_documento")
 */
class StatusDocumentoController extends AbstractController
{
    /**
     * @Route("/", name="status_documento_index", methods={"GET"})
     */
    public function index(StatusDocumentoRepository $statusDocumentoRepository): Response
    {
        return $this->render('status_documento/index.html.twig', [
            'status_documentos' => $statusDocumentoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="status_documento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $statusDocumento = new StatusDocumento();
        $form = $this->createForm(StatusDocumentoType::class, $statusDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statusDocumento);
            $entityManager->flush();

            return $this->redirectToRoute('status_documento_index');
        }

        return $this->render('status_documento/new.html.twig', [
            'status_documento' => $statusDocumento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="status_documento_show", methods={"GET"})
     */
    public function show(StatusDocumento $statusDocumento): Response
    {
        return $this->render('status_documento/show.html.twig', [
            'status_documento' => $statusDocumento,
        ]);
    }

    /**
     * @Route("/{id}/alterar", name="status_documento_edit", methods={"GET","POST"})
     */
    public function edit(
        Request $request,
        Documento $documento,
        UserInterface $user,
        StatusDocumentoRepository $statusDocumentoRepository
    ): Response {
        $statusDocumento = new StatusDocumento();
        $statusDoc = $statusDocumentoRepository->findOneBy(
            [
                'documento' => $documento
            ],
            [
                'id' => 'DESC'
            ]
        );
        $statusDocumento
            ->setData(new \DateTime(date('Y-m-d H:i:s')))
            ->setStatus($statusDoc->getStatus())
            ->setUser($user)
            ->setDocumento($documento);
        $form = $this->createForm(StatusDocumentoType::class, $statusDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statusDocumento);
            $entityManager->flush();

            return $this->redirectToRoute(
                'documento_index'
            );
        }

        return $this->render(
            'status_documento/edit.html.twig',
            [
                'status_documento' => $statusDocumento,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="status_documento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, StatusDocumento $statusDocumento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statusDocumento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($statusDocumento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('status_documento_index');
    }
}
