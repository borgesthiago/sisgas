<?php

namespace App\Controller;

use App\Entity\Habitacao;
use App\Form\HabitacaoType;
use App\Repository\HabitacaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/habitacao")
 */
class HabitacaoController extends AbstractController
{
    /**
     * @Route("/", name="habitacao_index", methods="GET")
     */
    public function index(HabitacaoRepository $habitacaoRepository): Response
    {
        return $this->render('habitacao/index.html.twig', ['habitacaos' => $habitacaoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="habitacao_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $habitacao = new Habitacao();
        $form = $this->createForm(HabitacaoType::class, $habitacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($habitacao);
            $em->flush();

            return $this->redirectToRoute('habitacao_index');
        }

        return $this->render('habitacao/new.html.twig', [
            'habitacao' => $habitacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="habitacao_show", methods="GET")
     */
    public function show(Habitacao $habitacao): Response
    {
        return $this->render('habitacao/show.html.twig', ['habitacao' => $habitacao]);
    }

    /**
     * @Route("/{id}/edit", name="habitacao_edit", methods="GET|POST")
     */
    public function edit(Request $request, Habitacao $habitacao): Response
    {
        $form = $this->createForm(HabitacaoType::class, $habitacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('habitacao_index', ['id' => $habitacao->getId()]);
        }

        return $this->render('habitacao/edit.html.twig', [
            'habitacao' => $habitacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="habitacao_delete", methods="DELETE")
     */
    public function delete(Request $request, Habitacao $habitacao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$habitacao->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($habitacao);
            $em->flush();
        }

        return $this->redirectToRoute('habitacao_index');
    }
}
