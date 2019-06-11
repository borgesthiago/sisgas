<?php

namespace App\Controller;

use App\Entity\Tramitacao;
use App\Form\TramitacaoType;
use App\Repository\TramitacaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tramitacao")
 */
class TramitacaoController extends AbstractController
{
    /**
     * @Route("/", name="tramitacao_index", methods="GET")
     */
    public function index(TramitacaoRepository $tramitacaoRepository): Response
    {
        return $this->render('tramitacao/index.html.twig', ['tramitacaos' => $tramitacaoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tramitacao_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tramitacao = new Tramitacao();
        $form = $this->createForm(TramitacaoType::class, $tramitacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tramitacao);
            $em->flush();

            return $this->redirectToRoute('tramitacao_index');
        }

        return $this->render('tramitacao/new.html.twig', [
            'tramitacao' => $tramitacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tramitacao_show", methods="GET")
     */
    public function show(Tramitacao $tramitacao): Response
    {
        return $this->render('tramitacao/show.html.twig', ['tramitacao' => $tramitacao]);
    }

    /**
     * @Route("/{id}/edit", name="tramitacao_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tramitacao $tramitacao): Response
    {
        $form = $this->createForm(TramitacaoType::class, $tramitacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tramitacao_index', ['id' => $tramitacao->getId()]);
        }

        return $this->render('tramitacao/edit.html.twig', [
            'tramitacao' => $tramitacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tramitacao_delete", methods="DELETE")
     */
    public function delete(Request $request, Tramitacao $tramitacao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tramitacao->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tramitacao);
            $em->flush();
        }

        return $this->redirectToRoute('tramitacao_index');
    }
}
