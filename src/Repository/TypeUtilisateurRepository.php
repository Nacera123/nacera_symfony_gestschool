<?php

namespace App\Repository;

use App\Entity\TypeUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query;
use Doctrine\Persistence\ManagerRegistry;

use function PHPUnit\Framework\returnSelf;

/**
 * @method TypeUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeUtilisateur[]    findAll()
 * @method TypeUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeUtilisateur::class);
    }

    public function getParent()
    {
        $query = $this->createQueryBuilder('zp'); //select zp.nom, zp.prenom from typeutilisateur as p join class eon t.id = zp.id
        $query->join('classe', 't');
        $query->select('zp.nom, zp.prenom');
        $query->groupBy('zp.nom');


        return $query->getQuery()->getResult();
    }

    public function getGestionnaireType()
    {
        $query = $this->createQueryBuilder('t');
        // $query->whereNotIn('t.role', ["Gestionaire_Ecole", "Administrateur"]);
        // $query->where('role NOT ("Gestionaire_Ecole","Administrateur")');
        $query->where($query->expr()->notIn('t.role',  ["Gestionnaire_Ecole", "Administrateur"]));

        return $query;
    }

    public function getAdministrateur()
    {
        $query = $this->createQueryBuilder('t');
        $query->where($query->expr()->in('t.role',  ["Gestionnaire_Ecole", "Administrateur"]));

        return $query;
    }

    // /**
    //  * @return TypeUtilisateur[] Returns an array of TypeUtilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeUtilisateur
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
