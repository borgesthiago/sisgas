<?php

namespace App\Repository;

use App\Entity\Tramitacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tramitacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tramitacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tramitacao[]    findAll()
 * @method Tramitacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TramitacaoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tramitacao::class);
    }

    // /**
    //  * @return Tramitacao[] Returns an array of Tramitacao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tramitacao
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
