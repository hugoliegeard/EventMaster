<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        # Création d'une catégorie "Spectacles"
        $category = new Category();
        $category->setName('Spectacles');

        # Persister la catégorie dans la base de données
        $manager->persist($category);

        # Création de 5 spectacles
        for ($i = 1; $i <= 5; $i++) {
            $show = new Event();
            $show->setTitle('Spectacle ' . $i);
            $show->setCategory($category); // Associer le spectacle à la catégorie "Spectacles"
            $manager->persist($show);
        }

        # Sauvegarder les changements dans la base de données
        $manager->flush();
    }
}
