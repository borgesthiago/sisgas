<?php

namespace App\Controller;

use DateTime;
use App\Entity\Status;
use App\Entity\Documento;
use App\Entity\Tramitacao;
use App\Form\DocumentoType;
use App\Form\EncaminhaType;
use App\Repository\StatusRepository;
use App\Repository\DocumentoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/documento")
 */
class DocumentoController extends AbstractController
{
    /**
     * @Route("/", name="documento_index", methods="GET")
     */
    public function index(DocumentoRepository $documentoRepository): Response
    {
        $documentos = $documentoRepository->findAll();
        foreach ($documentos as $documento) {
            $dataAutal = new DateTime(date('Y-m-d'));
            $dataRecebido = new DateTime($documento->getDataRecebido()->format('Y-m-d'));
            $intervalo = ($dataRecebido->diff($dataAutal))->format('%R%a dias');
        }
        return $this->render(
            'documento/index.html.twig',
            [
                'documentos' => $documentos
            ]
        );
    }

    /**
     * @Route("/new", name="documento_new", methods="GET|POST")
     */
    public function new(
        Request $request,
        UserInterface $user,
        StatusRepository $statusRepository
    ): Response {
        $documento = new Documento();
        $form = $this->createForm(DocumentoType::class, $documento);
        $form->handleRequest($request);
        $status = $statusRepository->findOneBy(['descricao' => 'Recebido']);

        if ($form->isSubmitted() && $form->isValid()) {
            $tramitacao = new Tramitacao();
            $tramitacao
                ->setOrigem($documento->getOrigem())
                ->setFuncionarioOrigem($user->getFuncionario())
                ->setFuncionarioDestino($user->getFuncionario())
                ->setDestino($user->getFuncionario()->getSecretaria())
                ->setStatus($status)
                ->setDataInicio(new \DateTime(date('Y-m-d')))
                ->setDataFim(new \DateTime(date('Y-m-d')))
            ;
            $documento->addTramitacao($tramitacao);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush();

            return $this->redirectToRoute('documento_index');
        }

        return $this->render('documento/new.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/encaminhar/{id}", name="documento_encaminhar", methods="GET|POST")
     */
    public function encaminhar(
        Request $request,
        Documento $documento,
        UserInterface $user,
        StatusRepository $statusRepository
    ): Response {
        $form = $this->createForm(EncaminhaType::class, $documento);
        $form->handleRequest($request);
        $status = $statusRepository->findOneBy(['descricao' => 'Em Análise']);
        if ($form->isSubmitted() && $form->isValid()) {
            $tramitacao = new Tramitacao();
            $tramitacao
                ->setOrigem($user->getFuncionario()->getSecretaria())
                ->setFuncionarioOrigem($user->getFuncionario())
                ->setDestino($documento->getOrigem())
                ->setStatus($status)
                ->setDataInicio(new \DateTime(date('Y-m-d')))
            ;
            // dump($tramitacao);die;
            $documento->addTramitacao($tramitacao);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tramitacao);
            $em->flush();

            return $this->redirectToRoute('documento_index', ['id' => $documento->getId()]);
        }

        return $this->render('documento/encaminhar.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="documento_show", methods="GET")
     */
    public function show(Documento $documento): Response
    {

        return $this->render(
            'documento/show.html.twig',
            [
                'documento' => $documento
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="documento_edit", methods="GET|POST")
     */
    public function edit(
        Request $request,
        Documento $documento
    ): Response {
        $form = $this->createForm(DocumentoType::class, $documento);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documento_index', ['id' => $documento->getId()]);
        }

        return $this->render('documento/edit.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="documento_delete", methods="DELETE")
     */
    public function delete(Request $request, Documento $documento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documento->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($documento);
            $em->flush();
        }

        return $this->redirectToRoute('documento_index');
    }
}
