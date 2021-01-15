<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="prostage_accueil")
     */
    public function index(): Response
    {
      //Récupération du repository des entités Entreprise, Formation et Stage
      $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
      //Récupération des entreprises, formations et stages enregistrés dans la BD
      $stages = $repositoryStage->findAll();

      //Envoie des entreprises, formations et stages récupérer à la vue chargé des les affichera
      return $this->render('pro_stage/index.html.twig',['stages'=>$stages]);
    }

    /**
     * @Route("/entreprises", name="prostage_entreprises")
     */
    public function entreprises()
    {
      //Récupération du repository de l'entité Entreprise
      $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

      //Récupération des entreprises enregistrés dans la BD
      $entreprises = $repositoryEntreprise->findAll();

      //Envoie des ressources entreprises à la vue chargé des les affichera
      return $this->render('pro_stage/entreprises.html.twig',['entreprises'=>$entreprises]);
    }

    /**
     * @Route("/formations", name="prostage_formations")
     */
    public function formations()
    {
        //Récupération du repository de l'entité Formation
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        //Récupération des formations enregistrés dans la BD
        $formations = $repositoryFormation->findAll();

        //Envoie des formations récupérer à la vue chargé des les affichera
        return $this->render('pro_stage/formations.html.twig',['formations'=>$formations]);
    }

    /**
     * @Route("/stages/{id}", name="prostage_stages")
     */
    public function stages($id)
    {
        //Récupération du repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Récupération des stages enregistrés dans la BD
        $stage = $repositoryStage->find($id);

        //Envoie des stages récupérer à la vue chargé des les affichera
        return $this->render('pro_stage/stages.html.twig',['stage' => $stage]);
    }

    /**
     * @Route("/{id}", name="prostage_tri_par_formation")
     */
    public function triParFormation($id)
    {
        //Récupération du repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Récupération des stages enregistrés dans la BD
        $stages = $repositoryStage->findByFormations($id);

        //Envoie des stages récupérer à la vue chargé des les affichera
        return $this->render('pro_stage/index.html.twig',['stages' => $stages]);
    }

    /**
     * @Route("/{idEntreprise}", name="prostage_tri_par_entreprise")
     */
    public function triParEntreprise($idEntreprise)
    {
        //Récupération du repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Récupération des stages enregistrés dans la BD
        $stages = $repositoryStage->findByEntreprise($idEntreprise);

        //Envoie des stages récupérer à la vue chargé des les affichera
        return $this->render('pro_stage/index.html.twig',['stages' => $stages]);
    }
}
