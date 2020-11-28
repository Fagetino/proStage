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
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }

    /**
     * @Route("/entreprises", name="prostage_entreprises")
     */
    public function entreprises()
    {
        return new Response(
            '<h1>Cette page affichera la liste des entreprises proposant un stage</h1>'
        );
    }

    /**
     * @Route("/formations", name="prostage_formations")
     */
    public function formations()
    {
        return new Response(
            '<h1>Cette page affichera la liste des formations de l\'IUT</h1>'
        );
    }

    /**
     * @Route("/stages/{id}", name="prostage_stages")
     */
    public function stages($id)
    {
        return new Response(
            '<h1>Cette page affichera le descriptif du stage ayant pour identifiant '.$id.'</h1>'
        );
    }
}
