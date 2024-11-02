<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $client = new Client();
            $client->setSurname("Client$i")
                   ->setTelephone("77$i$i$i$i$i")
                   ->setAdresse("Adresse $i");

            $manager->persist($client);
        }

        $manager->flush();
    }
}
