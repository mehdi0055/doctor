<?php

namespace App\Repository;

use App\Entity\SessionChat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SessionChat|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionChat|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionChat[]    findAll()
 * @method SessionChat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SessionChat::class);
    }

              /**
     * @return SessionChat[]
     */
    public function getSession($emaildestinateur,$emaildestinatair): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
            FROM App\Entity\SessionChat s
            WHERE s.destinateurEmail = :emaildestinateur AND s.destinatairEmail = :emaildestinatair 
            '
        )->setParameter('emaildestinateur',$emaildestinateur)->setParameter('emaildestinatair',$emaildestinatair);

        // returns an array of Product objects
        return $query->getResult();
    }

                /**
     * @return SessionChat[]
     */
    public function getSessions($emaildestinateur,$emaildestinatair): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
            FROM App\Entity\SessionChat s
            WHERE s.destinateurEmail = :emaildestinatair AND s.destinatairEmail = :emaildestinateur OR  s.destinatairEmail = :emaildestinatair AND s.destinateurEmail = :emaildestinateur  

            '
            )->setParameter('emaildestinateur',$emaildestinateur)->setParameter('emaildestinatair',$emaildestinatair);


        // returns an array of Product objects
        return $query->getResult();
    }

    // /**
    //  * @return SessionChat[] Returns an array of SessionChat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SessionChat
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
