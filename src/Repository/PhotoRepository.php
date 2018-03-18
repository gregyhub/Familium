<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use function dump;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    
    public function getPhotosByAlbum($idAlbum){
        // la table en base de données correspondant à l'entité liée au repository en cours
       $tablephoto = $this->getClassMetadata()->table["name"];
       

       // Dans mon cas je voulais trier mes résultats avec un ordre bien particulier
       $sql =  "SELECT p.* "
               ."FROM ".$tablephoto." AS p, photo_album AS pa "
               ."WHERE p.id = pa.photo_id "
               ."AND album_id = ". $idAlbum;
       $rsm = new ResultSetMappingBuilder($this->getEntityManager());
       $rsm->addEntityResult(Photo::class, "p");

       // On mappe le nom de chaque colonne en base de données sur les attributs de nos entités
       foreach ($this->getClassMetadata()->fieldMappings as $obj) {
           $rsm->addFieldResult("p", $obj["columnName"], $obj["fieldName"]);
       }

       $stmt = $this->getEntityManager()->createNativeQuery($sql, $rsm);


       $stmt->execute();

       return $stmt->getResult();
    }
    
    
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
