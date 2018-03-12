<?php

namespace App\Repository;

use App\Entity\Waitingroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Waitingroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Waitingroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Waitingroom[]    findAll()
 * @method Waitingroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaitingroomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Waitingroom::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('w')
            ->where('w.something = :value')->setParameter('value', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
