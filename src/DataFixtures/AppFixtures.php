<?php
namespace App\DataFixtures;

use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $produits = new Produits();
            $produits->setLabel('produits '.$i);
            $produits->setDescription('produits '.$i);
            $produits->setPrix(mt_rand(10, 100));
            $produits->setReference('produits '.$i);
            $produits->setImage('produits '.$i);
            $produits->setActif('produits '.$i);
            $manager->persist($produits);
        }

        $manager->flush();
    }
}