<?php

namespace App\DataFixtures;

use App\Entity\AuthenticatedUser;
use App\Entity\Tricks;
use App\DataFixtures\Faker\Provider;
use App\Entity\TricksGroup;
use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Comments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{


    /**
     * Remplissagge de la base donnéées à partir de figures
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Appelle de la librairie Faker
        $faker=\Faker\Factory::create('fr_FR');
        // on créé 18 Figures
        for ($i = 0; $i < 18; $i++) {
            // création de groupes de figures
            $group = new TricksGroup();
            $group->setName($faker->text(50));

            //creation d'un utilisateur
            $usera= new AuthenticatedUser();
            $usera->setUsername($faker->sentence(5));
            $usera->setFirstname($faker->firstName());
            $usera->setLastname($faker->lastName());
            $usera->setEmail($faker->email);
            $usera->setContact($faker->phoneNumber);
            $usera->setPassword($faker->password(6, 6));
            $usera->setPicture($faker->imageUrl(40, 40));

            // création d'une figure
            $tricks= new Tricks();
            $tricks->setName($faker->text(10));
            $tricks->setDescription($faker->text(35));
            $tricks->setCreatedate($faker->dateTime());
            $tricks->setUpdatedate($faker->dateTime());
            $tricks->setAuthenticateduser($usera);
            $tricks->setTricksgroup($group);

            for ($k = 1; $k <= rand(2, 6); $k++) {
                // création d'une vidéo
                $video= new Video();
                $video->setName($faker->imageUrl());
                $video->setAlt($faker->sentence(5));
                $video->setTricks($tricks);

                //création d'une image
                $image= new Image();
                $image->setName($faker->imageUrl());
                $image->setAlt($faker->sentence(5));
                $image->setTricks($tricks);

                //  création d'un commentaire
                $comments= new Comments();
                $comments->setContent($faker->text(150));

                $comments->setAuthenticateduser($usera);
                $comments->setTricks($tricks);

                $manager->persist($image);
                $manager->persist($video);

                $manager->persist($comments);
            }
            $manager->persist($group);

            $manager->persist($usera);
            $manager->persist($tricks);
        }
        $manager->flush();
    }
}
