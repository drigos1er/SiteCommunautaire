<?php

namespace App\DataFixtures;

use App\Entity\AuthenticatedUser;
use App\Entity\Figures;

use App\Entity\GroupFigures;
use App\Entity\Media;
use App\Entity\Messages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {

       $faker=\Faker\Factory::create('fr_FR');

        // $product = new Product();
        // $manager->persist($product);

         // on créé 10 personnes
        for ($i = 0; $i < 20; $i++) {
            $group = new GroupFigures();
            $group->setName($faker->text(50));

            $media= new Media();
            $media->setName($faker->text(50));
            $media->setType('VIDEO');
            $media->setState('0');

            $usera= new AuthenticatedUser();
            $usera->setUsername($faker->text(8));
            $usera->setFirstname($faker->firstName());
            $usera->setLastname($faker->lastName());
            $usera->setEmail($faker->email);
            $usera->setContact($faker->phoneNumber);
            $usera->setPassword($faker->password(6, 6));
            $usera->setPicture($faker->url);
            $usera->setCreatedate($faker->dateTime());
            $usera->setUpdatedate($faker->dateTime());


            $figures= new Figures();
            $figures->setName($faker->text(10));
            $figures->setDescription($faker->text(35));
            $figures->setCreatedate($faker->dateTime());
            $figures->setUpdatedate($faker->dateTime());
            $figures->setMedia($media);
            $figures->setGroupfigures($group);


            $messages= new Messages();
            $messages->setContent($faker->text(150));
            $messages->setCreatedate($faker->dateTime());
            $messages->setUpdatedate($faker->dateTime());
            $messages->setAuthenticateduser($usera);
            $messages->setFigures($figures);



            $manager->persist($group);
            $manager->persist($media);
            $manager->persist($usera);
            $manager->persist($figures);
            $manager->persist($messages);
        }


        $manager->flush();
    }
}
