<?php

namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    public function findPublicProduits(?int $nbProduits): array
    {
        sleep(3);
        $queryBuilder = $this->createQueryBuilder('r')
            ->where('r.actif = 1');


        if ($nbProduits !== 0 || $nbProduits !== null) {
            $queryBuilder->setMaxResults($nbProduits);
        }

        return $queryBuilder->getQuery()
            ->getResult();
    }
}
