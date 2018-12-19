<?php

namespace App\Repository;

use App\Entity\ActiveMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActiveMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiveMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiveMessage[]    findAll()
 * @method ActiveMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiveMessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActiveMessage::class);
    }

    // /**
    //  * @return ActiveMessage[] Returns an array of ActiveMessage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActiveMessage
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
