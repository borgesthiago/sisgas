<?php

namespace App\Repository;

use App\Entity\Equipamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Equipamento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipamento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipamento[]    findAll()
 * @method Equipamento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipamentoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Equipamento::class);
    }

    // /**
    //  * @return Equipamento[] Returns an array of Equipamento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Equipamento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
