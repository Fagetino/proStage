<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Création de générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        /************************************************
        ******* Creation des types Formation ***********
        ************************************************/
        $DUTinfo = new Formation();
        $DUTinfo->setIntitule('DUT Informatique');
        $DUTinfo->setDescription('Le DUT Informatique prépare à la conception, la réalisation et à la mise en œuvre de systèmes informatiques et de réseaux. Il prépare également à faire de l\'assistance technique et des activités de formation.');
        $manager->persist($DUTinfo);

        $LPM = new Formation();
        $LPM->setIntitule('Licence Professionnelle Multimédia');
        $LPM->setDescription('Une licence professionnelle en multimédia est un cursus d\'un an qui a pour but de former les étudiants aux métiers de la création, de la conception et de la réalisation de produits et de services multimédias.');
        $manager->persist($LPM);

        $DUTIC = new Formation();
        $DUTIC->setIntitule('DU TIC');
        $DUTIC->setDescription('Le DU TIC permet de maîtriser des techniques d\'information et de communication (TIC). Cette formation ne comprend donc pas seulement des notions d\'information, mais également de communication et de management.');
        $manager->persist($DUTIC);

        $tableauFormations = array($DUTinfo, $LPM, $DUTIC);

        /************************************************
        ******* Creation des types Entreprise ***********
        ************************************************/
        //Définition du nombre d'entreprises ajoutées
        $nbEntreprises = 6;

        for ($numEntreprise=0; $numEntreprise < $nbEntreprises; $numEntreprise++) {
          //Génération du nom de l'entreprise
          $nomEntreprise = $faker->company();
          //Remplacement des espace par des tiret et supression des points pour créer l'url de l'entrprise
          $nomDomaine = str_replace(' ','-',$nomEntreprise);
          $nomDomaine = str_replace('.','',$nomDomaine);
          //Création de l'url de l'entreprise
          $url = 'http://www.' . $nomDomaine . '.' . $faker->tld() . '/';
          //Création de l'entreprise
          $entreprise = new Entreprise();
          $entreprise->setNom($nomEntreprise);
          $entreprise->setActivite($faker->catchPhrase());
          $entreprise->setAdresse($faker->address());
          $entreprise->setSiteWeb($url);
          //Enregistrement de l'entreprise crée
          $manager->persist($entreprise);

          /*** Création de plusieurs stages associés à l'entreprise***/
          //Définition du nombre de stages ajoutés
          $nbStages = $faker->numberBetween($min = 0, $max = 3);
          //Génération du nom de domaine du mail de l'entreprise
          $domaineMail = $faker->freeEmailDomain();
          //Création du mail de l'entreprises
          $mail = $nomDomaine . '-stage' . '@' . $domaineMail;
          for ($numStage=0; $numStage < $nbStages; $numStage++) {
            //Création de l'entreprise
            $stage = new Stage();
            $stage->setTitre($faker->jobTitle());
            $stage->setMission($faker->text($maxNbChars = 1000));
            $stage->setAdresseMail($mail);
            //Création de la relation entre Entreprise et Stage
            $entreprise->addStage($stage);
            //Enregistrement des modifications apportées à entreprise
            $manager->persist($entreprise);
            //Enregistrement du stage crée
            $manager->persist($stage);

            /*** Association de plusieurs formations au stage***/
            //Définition du nombre de stages ajoutés
            $nbFormations=$faker->numberBetween($min = 0, $max = count($tableauFormations));
            for ($numFormation=0; $numFormation < $nbFormations; $numFormation++) {
              //Generation d'un numéro au hazard pour récupérer la formation dans le $tableauFormations
              $formation=$faker->numberBetween($min = 0, $max = count($tableauFormations)-1);

              //On vérifie si la formation a déjà été ajouté
              if(!in_array($tableauFormations[$formation],$stage->getFormations()->toArray())){
                //Création de la relation entre Formation et Stage
                $tableauFormations[$formation]->addStage($stage);
                //Enregistrement des modifications apportées à formation et stage
                $manager->persist($tableauFormations[$formation]);
                $manager->persist($stage);
              }
            }
          }
        }

        $manager->flush();
    }
}
