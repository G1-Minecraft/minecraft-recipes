<?php

namespace App\Repository;

use App\Entity\CraftSlot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CraftSlot>
 *
 * @method CraftSlot|null find($id, $lockMode = null, $lockVersion = null)
 * @method CraftSlot|null findOneBy(array $criteria, array $orderBy = null)
 * @method CraftSlot[]    findAll()
 * @method CraftSlot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CraftSlotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CraftSlot::class);
    }

//    /**
//     * @return CraftSlots[] Returns an array of CraftSlots objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CraftSlots
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
