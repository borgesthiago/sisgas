<?php

namespace App\Controller;

use App\Entity\Documento;
use App\Entity\Tramitacao;
use App\Form\DocumentoType;
use App\Entity\StatusDocumento;
use App\Repository\StatusRepository;
use App\Repository\DocumentoRepository;
use App\Repository\TramitacaoRepository;
use App\Repository\StatusDocumentoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route("/documento")
 */
class DocumentoController extends AbstractController
{
    /**
     * @Route("/", name="documento_index", methods="GET")
     */
    public function index(
        DocumentoRepository $documentoRepository,
        TramitacaoRepository $tramitacaoRepository,
        UserInterface $user,
        AuthorizationCheckerInterface $authChecker
    ): Response {
        $tramitacao = $tramitacaoRepository->findOneBy(
            [
                'destino' => $user->getFuncionario()->getSecretaria()
            ]
        );
        if ($authChecker->isGranted('ROLE_SUPER_ADMIN')) {
            $documentos = $documentoRepository->findAll();
        } else {
            $documentos = $documentoRepository
                ->findBySetor($tramitacao->getDestino());
        }
        return $this->render(
            'documento/index.html.twig',
            [
                'documentos' => $documentos,
                'tramitacoes' => $tramitacao
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
        $statusDocumento = new StatusDocumento();
        
        $form = $this->createForm(DocumentoType::class, $documento);
        $form->handleRequest($request);

        $status = $statusRepository->findOneBy(['descricao' => 'Recebido Externo']);

        if ($form->isSubmitted() && $form->isValid()) {
            $tramitacao = new Tramitacao();
            $tramitacao
                ->setOrigem($documento->getOrigem())
                ->setFuncionarioOrigem($user->getFuncionario())
                ->setFuncionarioDestino($user->getFuncionario())
                ->setDestino($user->getFuncionario()->getSecretaria())
                ->setDataInicio(new \DateTime(date('Y-m-d H:i:s')))
                ->setDataFim(new \DateTime(date('Y-m-d H:i:s')));

            $statusDocumento
                ->setData(new \DateTime(date('Y-m-d H:i:s')))
                ->setStatus($status)
                ->setDocumento($documento)
                ->setUser($user);

            $documento->addTramitacao($tramitacao);
            $documento->addStatusDocumento($statusDocumento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush();

            return $this->redirectToRoute('documento_index');
        }

        return $this->render(
            'documento/new.html.twig',
            [
                'documento' => $documento,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="documento_show", methods="GET")
     */
    public function show(
        Documento $documento,
        StatusDocumentoRepository $statusDocumentoRepository
    ): Response {
        $statusDocumento = $statusDocumentoRepository->findByDocumento($documento, 1);

        return $this->render(
            'documento/show.html.twig',
            [
                'documento' => $documento,
                'statusDocumento' => $statusDocumento
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

            return $this->redirectToRoute(
                'documento_index',
                [
                    'id' => $documento->getId()
                ]
            );
        }

        return $this->render(
            'documento/edit.html.twig',
            [
                'documento' => $documento,
                'form' => $form->createView(),
            ]
        );
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
