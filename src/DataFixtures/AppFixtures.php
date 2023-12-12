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
            ->setTitle($faker->sentence(4))
            ->setContent(implode("\n\n", $faker->paragraphs(3)))
            ->setDate($faker->dateTime);

        $manager->persist($newLesson);
        $manager->flush();
    }
}
