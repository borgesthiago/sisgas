<?php

namespace App\Repository;

use App\Entity\Servicos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Servicos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Servicos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Servicos[]    findAll()
 * @method Servicos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Servicos::class);
    }

    // /**
    //  * @return Servicos[] Returns an array of Servicos objects
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
    public function findOneBySomeField($value): ?Servicos
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
