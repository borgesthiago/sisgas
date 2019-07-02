<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/novo", name="user_novo", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $password = $encoder->encodePassword($user, $form->getData()->getPassword());
            $user->setPassword($password);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/novo.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_ver", methods="GET")
     */
    public function show(User $user): Response
    {
        return $this->render('user/ver.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/editar", name="user_editar", methods="GET|POST")
     */
    public function edit(
        Request $request,
        User $user,
        UserRepository $usuarioRepository,
        UserPasswordEncoderInterface $encoder
    ): Response {
       
        $usuarioDb = $usuarioRepository->find($user->getId());
        $senha = $usuarioDb->getPassword();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (null != $user->getPassword()) {
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
            } else {
                $user->setPassword($senha);
            }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Seus dados foram modificados com sucesso!');

            return $this->redirectToRoute('user_index', ['id' => $user->getId()]);
        }

        return $this->render('user/editar.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
