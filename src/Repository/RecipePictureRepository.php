<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\RecipePicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipePicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipePicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipePicture[]    findAll()
 * @method RecipePicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipePictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipePicture::class);
    }

    // /**
    //  * @return RecipePicture[] Returns an array of RecipePicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipePicture
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
