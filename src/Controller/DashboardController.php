<?php

namespace App\Controller;

use App\Repository\SecretariaRepository;
use App\Repository\FuncionarioRepository;
use App\Repository\RemuneracaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(
        SecretariaRepository $totalSecretaria,
        FuncionarioRepository $totalFuncionario,
        RemuneracaoRepository $totalRemuneracao,
        RemuneracaoRepository $totalGratificacao,
        RemuneracaoRepository $totalDesconto
    ) {
     
        $totalSec = $totalSecretaria->countAll();
        $totalFunc = $totalFuncionario->countAll();
        $totalRem = $totalRemuneracao->countSal();
        $totalGra = $totalGratificacao->countGra();
        $totalDesc = $totalDesconto->countDesc();
       
        return $this->render (
            'dashboard/index.html.twig',
            [
                'controller_name' => 'DashboardController',
                'totalSec' => $totalSec,
                'totalFunc' => $totalFunc,
                'totalRem'  => $totalRem,
                'totalGra'  => $totalGra,
                'totalDes'  => $totalDesc
            ]
        );
    }
}
