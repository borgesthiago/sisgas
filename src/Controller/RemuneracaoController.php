<?php

namespace App\Controller;

use App\Entity\Remuneracao;
use App\Form\RemuneracaoType;
use App\Repository\RemuneracaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/remuneracao")
 */
class RemuneracaoController extends AbstractController
{
    /**
     * @Route("/", name="remuneracao_index", methods="GET")
     */
    public function index(RemuneracaoRepository $remuneracaoRepository): Response
    {
        return $this->render('remuneracao/index.html.twig', ['remuneracaos' => $remuneracaoRepository->findAll()]);
    }

    /**
     * @Route("/novo", name="remuneracao_novo", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $remuneracao = new Remuneracao();
        $form = $this->createForm(RemuneracaoType::class, $remuneracao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($remuneracao);
            $em->flush();

            return $this->redirectToRoute('remuneracao_index');
        }

        return $this->render('remuneracao/novo.html.twig', [
            'remuneracao' => $remuneracao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="remuneracao_ver", methods="GET")
     */
    public function show(Remuneracao $remuneracao): Response
    {
        return $this->render('remuneracao/ver.html.twig', ['remuneracao' => $remuneracao]);
    }

    /**
     * @Route("/{id}/editar", name="remuneracao_editar", methods="GET|POST")
     */
    public function edit(Request $request, Remuneracao $remuneracao): Response
    {
        $form = $this->createForm(RemuneracaoType::class, $remuneracao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('remuneracao_index', ['id' => $remuneracao->getId()]);
        }

        return $this->render('remuneracao/editar.html.twig', [
            'remuneracao' => $remuneracao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="remuneracao_delete", methods="DELETE")
     */
    public function delete(Request $request, Remuneracao $remuneracao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$remuneracao->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($remuneracao);
            $em->flush();
        }

        return $this->redirectToRoute('remuneracao_index');
    }
}
