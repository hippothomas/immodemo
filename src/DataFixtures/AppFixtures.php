<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\PropertyType;
use App\Entity\Testimonial;
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
        $users = [];
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
            $users[] = $user;
		}

		// Generating Property Types
        $types = [];
        $types_name = ['Appartement', 'Maison', 'Terrain'];
		foreach ($types_name as $name) {
            $type = new PropertyType();
            $type->setName($name);
            $manager->persist($type);
            $types[] = $type;
        }

		// Generating Properties
        for ($i=0; $i < 30; $i++) {
            $property = new Property();
            $property->setReference('ref'.$faker->randomNumber(5, true));
            $property->setTitle($faker->sentence());
            $photos = [];
            for ($y=0; $y < 5; $y++) {
                $photos[] = 'https://picsum.photos/id/'.$faker->numberBetween(0, 300).'/735/365';
            }
            $property->setPhotos($photos);
            $property->setPrice($faker->randomFloat(2, 80000, 3000000));
            $property->setType($types[$faker->numberBetween(0, 2)]);
            $property->setStatus($faker->numberBetween(0, 2));
            $property->setFeatured($faker->boolean());
            $property->setAgent($users[$faker->numberBetween(0, 4)]);
            $property->setRoom($faker->numberBetween(1, 10));
            $property->setBedroom($faker->numberBetween(1, 10));
            $property->setLivingArea($faker->randomFloat(2, 10, 10000));
            $property->setTotalArea($faker->randomFloat(2, 10, 10000));
            $property->setCity($faker->city());
            $property->setPostalCode($faker->postcode());
            $property->setDescription($faker->paragraphs(4, true));
            $property->setCoordinateX($faker->longitude());
            $property->setCoordinateY($faker->latitude());
            $property->setDpe($faker->numberBetween(10, 200));
            $property->setGes($faker->numberBetween(10, 80));
            $manager->persist($property);
        }

        // Generating Testimonials
        for ($i=0; $i < 6; $i++) {
            $testimonial = new Testimonial();
            $testimonial->setFullname($faker->name());
            $testimonial->setPropertyName($faker->sentence(4));
            $testimonial->setContent($faker->paragraph());
            $manager->persist($testimonial);
        }

        $manager->flush();
    }
}
