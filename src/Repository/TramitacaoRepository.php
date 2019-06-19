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

    public function findByDocumentoNaoRecebido($documento)
    {
        $q = $this->createQueryBuilder('t');
        return $q
                ->where(
                 $q->expr()
                    ->andX(
                        $q->expr()->isNull('t.funcionarioDestino'),
                        $q->expr()->isNull('t.dataFim'),
                        ('t.documento = :documento')
                    )
                )
                ->setParameter('documento', $documento)
                ->getQuery()
                ->getResult()
        ;
    }
}
