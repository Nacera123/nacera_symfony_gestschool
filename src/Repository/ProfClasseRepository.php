<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use App\Entity\TypeUtilisateur;
use App\Entity\Utilisateur;
use App\Entity\ProfClasse;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfClasse[]    findAll()
 * @method ProfClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfClasse::class);
    }

    public function show_prof()
    {
        $query = $this->createQueryBuilder('p');
        $query->where($query->expr()->notIn('p.role', ["Famille", "Gestionnaire_Ecole", "Administrateur"]));
    }

    // /**
    //  * @return ProfClasse[] Returns an array of ProfClasse objects
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
    public function findOneBySomeField($value): ?ProfClasse
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
