<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $adminUser = new User();
        $adminUser->setUsername('admin');
        $adminUser->setEmail('uros@admin.com');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setPassword(
                $this->passwordHasher->hashPassword(
                    $adminUser,
                    'adminadmin'
                )
            );
        $manager->persist($adminUser);

        $guestUser = new User();
        $guestUser->setUsername('guest');
        $guestUser->setEmail('uros@guest.com');
        $guestUser->setRoles(['ROLE_USER']);
        $guestUser->setPassword(
            $this->passwordHasher->hashPassword(
                $guestUser,
                'guestguest'
            )
        );
        $manager->persist($guestUser);

        $reviwerUser = new User();
        $reviwerUser->setUsername('urosteller');
        $reviwerUser->setEmail('uros@author.com');
        $reviwerUser->setRoles(['ROLE_REVIEWER']);
        $reviwerUser->setPassword(
            $this->passwordHasher->hashPassword(
                $reviwerUser,
                'urosuros'
            )
        );
        $manager->persist($reviwerUser);

        $manager->flush();
        
        $this->addReference('reviewerUser1', $reviwerUser);
    }
}
