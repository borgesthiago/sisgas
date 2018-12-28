<?php

namespace App\Repository;

use App\Entity\Remuneracao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Remuneracao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remuneracao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remuneracao[]    findAll()
 * @method Remuneracao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemuneracaoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Remuneracao::class);
    }

    public function countSal()
    {
        return $this->createQueryBuilder('r')
            ->select('sum(r.salario)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countGra()
    {
        return $this->createQueryBuilder('r')
            ->select('sum(r.gratificacao)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countDesc()
    {
        return $this->createQueryBuilder('r')
            ->select('sum(r.desconto)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
