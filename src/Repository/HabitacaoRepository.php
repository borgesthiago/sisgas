<?php

namespace App\Repository;

use App\Entity\Habitacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Habitacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Habitacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Habitacao[]    findAll()
 * @method Habitacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HabitacaoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Habitacao::class);
    }

    // /**
    //  * @return Habitacao[] Returns an array of Habitacao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Habitacao
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
