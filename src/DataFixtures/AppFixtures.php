<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('FR-fr');

		// Generating Users
        $userData = ['olivier.luile', 'pierre.lotissement', 'marie.maisonette', 'jeanne.duprix', 'alexandra.visite'];
		foreach ($userData as $username) {
            $identity = explode('.', $username);

			$user = new User();
            $password = $this->hasher->hashPassword(
                $user, "password"
            );
			$user->setUsername($username);
			$user->setPassword($password);
			$user->setRoles(["ROLE_USER"]);
            $user->setEmail("{$username}@immodemo.fr");
            $user->setLastname(ucfirst($identity[1]));
            $user->setFirstname(ucfirst($identity[0]));
            $user->setPhone($faker->e164PhoneNumber());
            $user->setPosition($faker->jobTitle());
            $user->setPhoto("/images/pages/home/team/{$identity[0]}.jpg");
			$manager->persist($user);
		}

        $manager->flush();
    }
}
