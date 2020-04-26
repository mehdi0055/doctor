<?php

namespace App\Repository;

use App\Entity\Pediatres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pediatres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pediatres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pediatres[]    findAll()
 * @method Pediatres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PediatresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pediatres::class);
    }

    
         /**
     * @return Pediatres[]
     */
    public function getnomPediatre($idPediatre): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Pediatres p
            WHERE p.id = :idPediatre
            '
        )->setParameter('idPediatre', $idPediatre);

        // returns an array of Product objects
        return $query->getResult();
    }


             /**
     * @return Pediatres[]
     */
    public function getPediatre($email): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Pediatres p
            WHERE p.email = :email
            '
        )->setParameter('email', $email);

        // returns an array of Product objects
        return $query->getResult();
    }

               /**
     * @return Pediatres[]
     */
    public function getPediatree($idUser): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Pediatres p
            WHERE p.idUser = :idUser
            '
        )->setParameter('idUser', $idUser);

        // returns an array of Product objects
        return $query->getResult();
    }

    // /**
    //  * @return Pediatres[] Returns an array of Pediatres objects
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
    public function findOneBySomeField($value): ?Pediatres
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
