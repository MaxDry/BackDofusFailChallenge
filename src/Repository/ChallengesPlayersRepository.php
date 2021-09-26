<?php

namespace App\Repository;

use App\Entity\ChallengesPlayers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChallengesPlayers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChallengesPlayers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChallengesPlayers[]    findAll()
 * @method ChallengesPlayers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengesPlayersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChallengesPlayers::class);
    }

    // /**
    //  * @return ChallengesPlayers[] Returns an array of ChallengesPlayers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChallengesPlayers
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
