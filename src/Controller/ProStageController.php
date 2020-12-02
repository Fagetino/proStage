<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="prostage_accueil")
     */
    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig');
    }

    /**
     * @Route("/entreprises", name="prostage_entreprises")
     */
    public function entreprises()
    {
      return $this->render('pro_stage/entreprises.html.twig');
    }

    /**
     * @Route("/formations", name="prostage_formations")
     */
    public function formations()
    {
        return $this->render('pro_stage/formations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="prostage_stages")
     */
    public function stages($id)
    {
        return $this->render('pro_stage/stages.html.twig',
        ['idStage' => $id]);
    }
}
