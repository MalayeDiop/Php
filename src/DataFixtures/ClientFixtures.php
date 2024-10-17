<?php

namespace App\DataFixtures;

use App\Entity\UserEntity;
use App\Entity\ClientEntity;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $client = new ClientEntity();
            $client->setPrenom('Prenom', $i);
            $client->setNom('Nom', $i);
            $client->setTelephone('012345678', $i);
            $client->setAdresse('Adresse', $i);
            if ($i % 2 == 0) {
                $user = new UserEntity();
                $user->setLogin('Login', $i);
                $user->setPassword('Password', $i);
                // $client->setUser($user);
            }
            $manager->persist($client);
        }

        $manager->flush();
    }
}
