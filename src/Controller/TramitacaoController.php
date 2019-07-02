<?php

namespace App\Controller;

use App\Entity\Documento;
use App\Entity\Tramitacao;
use App\Form\TramitacaoType;
use App\Entity\StatusDocumento;
use App\Repository\StatusRepository;
use App\Repository\TramitacaoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tramitacao")
 */
class TramitacaoController extends AbstractController
{
    /**
     * @Route("/", name="tramitacao_index", methods="GET")
     */
    public function index(
        TramitacaoRepository $tramitacaoRepository
    ): Response {
        $tramitacoes = $tramitacaoRepository->findAll();
        return $this->render(
            'tramitacao/index.html.twig',
            [
                'tramitacaos' => $tramitacoes
            ]
        );
    }

    /**
     * @Route("/new/{id}", name="tramitacao_new", methods="GET|POST")
     */
    public function new(
        Request $request,
        TramitacaoRepository $tramitacaoRepository,
        StatusRepository $statusRepository,
        UserInterface $user,
        Documento $documento
    ): Response {
        $tramitacao = new Tramitacao();
        $statusDocumento = new StatusDocumento();

        $form = $this->createForm(TramitacaoType::class, $tramitacao);
        $form->handleRequest($request);

        $status = $statusRepository->findOneBy(['descricao' => 'Enviado']);

        //verificar se já não foi encaminhada para o setor
        $documentoTramitado = $tramitacaoRepository
            ->findByDocumentoNaoRecebido($documento);
        if ($documentoTramitado != null) {
            $this->addFlash(
                'warning',
                'O Documento já foi Encaminhado e precisa ser recebido no setor de Destino. '
            );

            return $this->redirectToRoute('documento_index');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $tramitacao
                ->setDataInicio(new \DateTime(date('Y-m-d H:i:s')))
                ->setDocumento($documento)
                ->setFuncionarioOrigem($user->getFuncionario())
                ->setOrigem($user->getFuncionario()->getSecretaria());

            $statusDocumento
                ->setData(new \DateTime(date('Y-m-d H:i:s')))
                ->setStatus($status)
                ->setDocumento($documento)
                ->setUser($user);

            $documento->addStatusDocumento($statusDocumento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tramitacao);
            $em->flush();

            return $this->redirectToRoute('documento_index');
        }

        return $this->render(
            'tramitacao/new.html.twig',
            [
                'tramitacao' => $tramitacao,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/receber/{id}", name="tramitacao_receber", methods="GET|POST")
     */
    public function receber(
        Documento $documento,
        TramitacaoRepository $tramitacaoRepository,
        StatusRepository $statusRepository,
        UserInterface $user
    ): Response {
        $statusDocumento = new StatusDocumento();

        $status = $statusRepository->findOneBy(['descricao' => 'Recebido']);

        $tramitacao =
            $tramitacaoRepository->findOneBy(
                [
                    'documento' => $documento
                ],
                [
                    'id' => 'DESC'
                ]
            );
            $tramitacao
                ->setDataFim(new \DateTime(date('Y-m-d H:i:s')))
                ->setFuncionarioDestino($user->getFuncionario())
                ->setDocumento($documento);

            $statusDocumento
                ->setData(new \DateTime(date('Y-m-d H:i:s')))
                ->setStatus($status)
                ->setDocumento($documento)
                ->setUser($user);

            $documento->addStatusDocumento($statusDocumento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tramitacao);
            $em->flush();
            $this->addFlash(
                'success',
                'O Documento recebido com sucesso. '
            );
            return $this->redirectToRoute('documento_index');
       
    }

    /**
     * @Route("/{id}", name="tramitacao_show", methods="GET")
     */
    public function show(Tramitacao $tramitacao): Response
    {
        return $this->render(
            'tramitacao/show.html.twig',
            [
                'tramitacao' => $tramitacao
            ]
        );
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

            return $this->redirectToRoute(
                'tramitacao_index',
                [
                    'id' => $tramitacao->getId()
                ]
            );
        }

        return $this->render(
            'tramitacao/edit.html.twig',
            [
                'tramitacao' => $tramitacao,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="tramitacao_delete", methods="DELETE")
     */
    public function delete(Request $request, Tramitacao $tramitacao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tramitacao->getId(), $request->request->get('_token'))
        ) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tramitacao);
            $em->flush();
        }

        return $this->redirectToRoute('tramitacao_index');
    }
}
