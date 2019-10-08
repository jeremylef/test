<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use app\Entity\Identity;

class IdentityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
     for($i=1 ; $i <=5; $i ++){
         $identity=new Identity();
         $identity  ->setName("Personne n°$i");
         $identity  ->setFirstName("Prénom de la Personne n°$i");
         $identity  ->setAge("Age de la Personne n°$i");
         $manager->persist($identity);
    }
       
        $manager->flush();
    }
}
