<?php

namespace App\Repository;

use App\Entity\Birth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Birth|null find($id, $lockMode = null, $lockVersion = null)
 * @method Birth|null findOneBy(array $criteria, array $orderBy = null)
 * @method Birth[]    findAll()
 * @method Birth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BirthRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Birth::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.something = :value')->setParameter('value', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
