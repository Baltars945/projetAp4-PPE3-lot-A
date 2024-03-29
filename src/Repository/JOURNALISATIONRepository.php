<?php

namespace App\Repository;

use App\Entity\JOURNALISATION;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JOURNALISATION>
 *
 * @method JOURNALISATION|null find($id, $lockMode = null, $lockVersion = null)
 * @method JOURNALISATION|null findOneBy(array $criteria, array $orderBy = null)
 * @method JOURNALISATION[]    findAll()
 * @method JOURNALISATION[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JOURNALISATIONRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JOURNALISATION::class);
    }

//    /**
//     * @return JOURNALISATION[] Returns an array of JOURNALISATION objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JOURNALISATION
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
