<?php

namespace App\Repository;

use App\Entity\Documento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Documento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Documento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Documento[]    findAll()
 * @method Documento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Documento::class);
    }

    public function findBySetor($setor)
    {
        $q = $this->createQueryBuilder('d');
        return $q
                ->join('d.tramitacao', 't')
                ->where('t.destino = :val')
                ->setParameter('val', $setor)
                ->orderBy('d.id', 'ASC')
                ->getQuery()
                ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Documento
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
