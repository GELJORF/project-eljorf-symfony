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
            ->setTitle($faker->sentence('worried baby')) /* phrase générée par Random Everything*/
            ->setContent($faker->paragraphs(('again thread above applied number rays handsome attempt grandmother cookies fear are copy indeed pie paragraph cabin lesson home valley stairs fewer her former'), true)); 
            /* texte généré par Random Everything*/

        $manager->persist($newLesson);
        $manager->flush();
    }
}

/** Ceci est un exemple d'utilisation des fixtures (afin de créer un nouveau cours), 
 * celles-ci n'ont pas été rechargées */
