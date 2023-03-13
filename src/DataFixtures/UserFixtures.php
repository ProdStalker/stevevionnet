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
        $userAdmin = (new User())
            ->setRoles([
                'ROLE_SUPER_ADMIN'
            ])
            ->setUsername('prodstalker')
            ->setEmail('prod.stalker@gmail.com')
            ->setFirstName('Steve')
            ->setLastName('Vionnet');

        $userAdmin->setPassword($this->userPasswordHasher->hashPassword(
            $userAdmin,
            '123456'
        ));

        $manager->persist($userAdmin);

        $userTest = (new User())
            ->setRoles([
                'ROLE_TEST'
            ])
            ->setFirstName('Test')
            ->setLastName('User')
            ->setUsername('test')
            ->setEmail('test@stevevionnet.com');

        $userTest->setPassword($this->userPasswordHasher->hashPassword(
                $userTest,
                '123456'
            ));

        $manager->flush();
    }
}
