<?php

namespace App\Repository;

use App\Entity\StatusDocumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatusDocumento|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusDocumento|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusDocumento[]    findAll()
 * @method StatusDocumento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusDocumentoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatusDocumento::class);
    }

    
    public function findByDocumento($documento, $limit)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.documento = :val')
            ->setParameter('val', $documento)
            ->orderBy('s.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getSingleResult();
    }

    /*
    public function findOneBySomeField($value): ?StatusDocumento
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
