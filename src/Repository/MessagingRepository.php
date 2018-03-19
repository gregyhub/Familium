<?php

namespace App\Repository;

use App\Entity\Messaging;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Messaging|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messaging|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messaging[]    findAll()
 * @method Messaging[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Messaging::class);
    }
    
    public function countNews(User $recipient)
    {
        return $this->createQueryBuilder('m')
            ->select('count(m.id)')
            ->where('m.newmessage = :value')->setParameter('value', 'new')
            ->andWhere('m.recipient = :recipient')->setParameter('recipient', $recipient)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
