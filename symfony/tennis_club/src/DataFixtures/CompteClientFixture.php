<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\CompteClient;

class CompteClientFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        // $nom = array("Shimxa","Dardir","Belegdis","Curohir","Aediel","Elra","Ne'syl","Rilcircu","Thilrian","Ceren");
        // $prenom = array("Charles","Lidia","Malcolm","Gaspard","Marco","Dave","Elias","Constance","Emeline","Clementine");
        // $pseudo = array("Sowsard","Yerath","Volrod","Flarare","Elley","Ruffvan","Raeaye","Tarkhgar","Nomylan","Dwarftor");
        // $tel = array("1234567890","7418529630","4125647325","6542013659","0124785963","1023659874","4125478965","0102365985","6569875632","8789654126");
        // $mdp = array("2kcFi2LU6","K9Ldjw72N","9aQFf9f4E","8RmP3Rv8u","m4v9bTK7C","s75R4XfTk","iU4qNS75v","23txQ6VwP","u52P6AUbc","Xyn76x3RC");
        // for ( $i = 0; $i < 10; $i++)
        // {
        //     $compte = new CompteClient();
        //     $compte ->setID($i)
        //             ->setNom($nom[$i])
        //             ->setPrenom($prenom[$i])
        //             ->setPseudo($pseudo[$i])
        //             ->setTel($tel[$i])
        //             ->setMail("azerty@aezar.fr")
        //             ->setMdp($mdp[$i])
        //             ->setDateDeNaissance(new \DateTime())
        //             ->setDroits(1)
        //             ->setClassement("oui");



        //     $manager->persist($compte);
        // }
        

        // $manager->flush();

        $compte = new CompteClient();
        $compte ->setID(0)
                ->setNom("root")
                ->setPrenom("root")
                ->setPseudo("root")
                ->setTel("0123456789")
                ->setMail("root@admin.com")
                ->setMdp(hash('sha512',"root"))
                ->setDateDeNaissance(new \DateTime())
                ->setDroits(0);
        $manager->persist($compte);
        $manager->flush();

    }
}
