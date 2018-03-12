<?php

namespace App\Repository;

use App\Entity\SuperArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuperArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperArticle[]    findAll()
 * @method SuperArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuperArticle::class);
    }

    public function findAllArticles(\App\Entity\Category $category=null){
        $qb = $this->createQueryBuilder('a');
        $qb ->orderBy('a.id', 'DESC');
        if(!is_null($category)){
            //$qb->andWhere('IDENTITY(a.category) = '. $category->getId());
            $qb ->andWhere('IDENTITY(a.category) = :category')
                ->setParameter('category', $category->getId());
        }
        return $qb->getQuery()->getResult();
    }
    
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.something = :value')->setParameter('value', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
