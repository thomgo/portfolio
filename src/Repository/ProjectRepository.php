<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }


    /**
     *@return Array Returns array of projects
     */
    public function getProjectsSuperiorTo(int $position) {
      return $this->createQueryBuilder('p')
      ->where('p.position > :position')
      ->setParameter('position', $position)
      ->getQuery()
      ->execute();
    }

    /**
     *@return Integer Returns the total number of projects
     */
    public function getNumberProjects() {
      return $this->createQueryBuilder('p')
      ->select('count(p.id)')
      ->getQuery()
      ->getSingleScalarResult();
    }

    /**
     *@return Integer Returns the last position
     */
    public function getLastPosition() {
      return $this->createQueryBuilder('p')
      ->select('max(p.position)')
      ->getQuery()
      ->getSingleScalarResult();
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
