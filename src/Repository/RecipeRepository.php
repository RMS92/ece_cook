<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\RecipePicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Recipe::class);
        $this->paginator = $paginator;
    }

    /**
     * @param int $page
     * @return PaginationInterface
     */
    public function paginateAllVisible(int $page): PaginationInterface
    {
        $query =  $this->findVisibleQuery();

        return $this->paginator->paginate(
            $query->getQuery(),
            $page,
            3
        );
    }

    /**
     * @param int $page
     * @param int $id
     * @return PaginationInterface
     */
    public function paginateRecipeForCategory(int $page, int $id): PaginationInterface
    {
        $query =  $this->findVisibleQuery()
            ->join('r.category', 'c',)
            ->andWhere('c.id = :id')
            ->setParameter('id', $id);

        return $this->paginator->paginate(
            $query->getQuery(),
            $page,
            3
        );
    }

    /**
     * @param int $page
     * @param int $id
     * @return PaginationInterface
     */
    public function paginateRecipeForUser(int $page, int $id): PaginationInterface
    {
        $query =  $this->findVisibleQuery()
            ->join('r.author', 'a',)
            ->andWhere('a.id = :id')
            ->setParameter('id', $id);

        return $this->paginator->paginate(
            $query->getQuery(),
            $page,
            3
        );
    }

    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults('4')
            ->getQuery()
            ->getResult();
    }

    public function findForSidebar(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults('3')
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->select('r')
            ->andWhere('r.active = true')
            ->orderBy('r.created_at', 'DESC');
    }

    // /**
    //  * @return Recipe[] Returns an array of Recipe objects
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
    public function findOneBySomeField($value): ?Recipe
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
