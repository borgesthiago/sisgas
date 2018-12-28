<?php

namespace App\Controller;

use App\Entity\SubSecretaria;
use App\Form\SubSecretariaType;
use App\Repository\SubSecretariaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sub/secretaria")
 */
class SubSecretariaController extends AbstractController
{
    /**
     * @Route("/sub", name="subsecretaria_index", methods="GET")
     */
    public function index(SubSecretariaRepository $subSecretariaRepository): Response
    {
        return $this->render('subsecretaria/index.html.twig', ['sub_secretarias' => $subSecretariaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="sub_secretaria_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $subSecretarium = new SubSecretaria();
        $form = $this->createForm(SubSecretariaType::class, $subSecretarium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subSecretarium);
            $em->flush();

            return $this->redirectToRoute('sub_secretaria_index');
        }

        return $this->render('subsecretaria/new.html.twig', [
            'sub_secretarium' => $subSecretarium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sub_secretaria_show", methods="GET")
     */
    public function show(SubSecretaria $subSecretarium): Response
    {
        return $this->render('subsecretaria/show.html.twig', ['sub_secretarium' => $subSecretarium]);
    }

    /**
     * @Route("/{id}/edit", name="sub_secretaria_edit", methods="GET|POST")
     */
    public function edit(Request $request, SubSecretaria $subSecretarium): Response
    {
        $form = $this->createForm(SubSecretariaType::class, $subSecretarium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sub_secretaria_index', ['id' => $subSecretarium->getId()]);
        }

        return $this->render('subsecretaria/edit.html.twig', [
            'sub_secretarium' => $subSecretarium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sub_secretaria_delete", methods="DELETE")
     */
    public function delete(Request $request, SubSecretaria $subSecretarium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subSecretarium->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subSecretarium);
            $em->flush();
        }

        return $this->redirectToRoute('subsecretaria_index');
    }
}
