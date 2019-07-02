<?php

namespace App\Repository;

use Doctrine\ORM\Query\Expr\Join;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;
use App\Entity\Funcionario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Funcionario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Funcionario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Funcionario[]    findAll()
 * @method Funcionario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FuncionarioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Funcionario::class);
    }

    public function countAll()
    {
        return $this->createQueryBuilder('f')
            ->select('count(f.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    
    public function getFuncionarioAtivoPorData($dataInicio, $dataFim, $status)
    {
        $q = $this->createQueryBuilder("f");
        $campo = false;
        if ($status == '1') {
            $campo = 'f.admissao';
        } elseif ($status == '0' and 'f.exoneracao' != null) {
            $campo = 'f.exoneracao';
        }
            $q->where(
                $q->expr()->between($campo, ':data1', ':data2')
            );
            $q->andWhere("f.status = '$status'");
            //$q->andWhere("f.tipo = '$tipo'");
            $q->setParameter('data1', $dataInicio->format('Y-m-d'));
            $q->setParameter('data2', $dataFim->format('Y-m-d'));
            return $q->getQuery()->getResult();
    }

    public function salarioTotal()
    {
        $q = $this->createQueryBuilder("f")
            ->select('s.nome, SUM(r.salario) as total')
            ->join("App\Entity\Secretaria", 's', Join::WITH, 'f.secretaria = s.id')
            ->join("App\Entity\Remuneracao", 'r', Join::WITH, 'f.remuneracao = r.id')
            ->where('f.status = :status ')
            ->groupBy("s.nome")
            ->setParameter(':status', '1')
            ->getQuery();
        return $q->getResult();
    }
}
