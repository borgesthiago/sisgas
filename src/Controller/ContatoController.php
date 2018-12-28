<?php

namespace App\Controller;

use App\Entity\Contato;
use App\Form\ContatoType;
use App\Repository\ContatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contato")
 */
class ContatoController extends AbstractController
{
    /**
     * @Route("/", name="contato_index", methods="GET")
     */
    public function index(ContatoRepository $contatoRepository): Response
    {
        return $this->render('contato/index.html.twig', ['contatos' => $contatoRepository->findAll()]);
    }

    /**
     * @Route("/novo", name="contato_novo", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $contato = new Contato();
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contato);
            $em->flush();

            return $this->redirectToRoute('contato_index');
        }

        return $this->render('contato/novo.html.twig', [
            'contato' => $contato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contato_ver", methods="GET")
     */
    public function show(Contato $contato): Response
    {
        return $this->render('contato/ver.html.twig', ['contato' => $contato]);
    }

    /**
     * @Route("/{id}/editar", name="contato_editar", methods="GET|POST")
     */
    public function edit(Request $request, Contato $contato): Response
    {
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contato_index', ['id' => $contato->getId()]);
        }

        return $this->render('contato/editar.html.twig', [
            'contato' => $contato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contato_delete", methods="DELETE")
     */
    public function delete(Request $request, Contato $contato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contato->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contato);
            $em->flush();
        }

        return $this->redirectToRoute('contato_index');
    }
}
