<?php

namespace App\Repository;

use App\Entity\SubSecretaria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SubSecretaria|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubSecretaria|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubSecretaria[]    findAll()
 * @method SubSecretaria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubSecretariaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SubSecretaria::class);
    }

    // /**
    //  * @return SubSecretaria[] Returns an array of SubSecretaria objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubSecretaria
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
