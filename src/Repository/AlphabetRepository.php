<?php

namespace App\Repository;

use App\Entity\Alphabet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Alphabet>
 *
 * @method Alphabet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alphabet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alphabet[]    findAll()
 * @method Alphabet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlphabetRepository extends ServiceEntityRepository
{
    public function findAllLessonsWithContent()
    {
        return $this->createQueryBuilder('c')
        ->select('c.id', 'c.title', 'c.content')
        ->getQuery()
        ->getResult();
    }
//    /**
//     * @return Alphabet[] Returns an array of Alphabet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Alphabet
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
