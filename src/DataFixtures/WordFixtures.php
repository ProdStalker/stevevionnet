<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Word;
use App\Entity\WordCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WordFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(){
    }

    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Programming' => [
                'PHP', 'Javascript', 'Flutter', 'HTML', 'CSS',
                'Python', 'JAVA', 'C#', 'C', 'C++',
                'Android', 'React', 'Angular', 'Node.js'
            ]
        ];

        foreach($categories as $categoryName => $words){
            foreach($words as $wordName){
                $word = new Word();
                $word->setName($wordName);
                $word->addCategory($this->getReference($categoryName));
                $manager->persist($word);
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            WordCategoryFixtures::class
        ];
    }
}
