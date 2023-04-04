<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\WordCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WordCategoryFixtures extends Fixture
{
    public function __construct(){
    }

    public function load(ObjectManager $manager): void
    {
        $categoryNames = [
            'Programming'
        ];

        foreach($categoryNames as $categoryName){
            $category = new WordCategory();
            $category->setName($categoryName);

            $manager->persist($category);

            $this->setReference($categoryName, $category);
        }

        $manager->flush();
    }
}
