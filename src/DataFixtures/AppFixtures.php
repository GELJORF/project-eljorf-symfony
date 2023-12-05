<?php

namespace App\DataFixtures;

use App\Entity\Alphabet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        $newLesson = new Alphabet();
        $newLesson
            ->setTitle($faker->sentence)
            ->setContent($faker->paragraphs(3, true));

        $manager->persist($newLesson);
        $manager->flush();
    }
}

/** Ceci est un exemple d'utilisation des fixtures (afin de créer un nouveau cours), 
 * celles-ci n'ont pas été rechargées */
