<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly  UserPasswordHasherInterface $userPasswordHasher){
    }

    public function load(ObjectManager $manager): void
    {
        $userAdmin = new User();
        $userAdmin->setRoles([
            'ROLE_ADMIN'
        ])
        ->setUsername('prodstalker')
        ->setEmail('prod.stalker@gmail.com')
        ->setPassword($this->userPasswordHasher->hashPassword(
            $userAdmin,
            '123456'
        ));

        $manager->persist($userAdmin);

        $userTest = new User();
        $userTest->setRoles([
            'ROLE_SUPER_ADMIN'
        ])
        ->setUsername('test')
        ->setEmail('test@stevevionnet.com')
        ->setPassword($this->userPasswordHasher->hashPassword(
            $userTest,
            '123456'
        ));

        $manager->flush();
    }
}
