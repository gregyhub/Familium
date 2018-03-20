<?php

namespace App\Repository;

use App\Entity\RequestPassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RequestPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestPassword[]    findAll()
 * @method RequestPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestPasswordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RequestPassword::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('r')
            ->where('r.something = :value')->setParameter('value', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
