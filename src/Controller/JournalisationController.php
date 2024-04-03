<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JOURNALISATIONRepository;


class JournalisationController extends AbstractController
{
    #[Route('/journalisation/{id}', name: 'app_journalisation')]
    public function index(int $id,JOURNALISATIONRepository $journalisationrepository): Response
    {
        $journalisationrepository = $journalisationrepository ->findAll();
        return $this->render('journalisation/index.html.twig', [
            'controller_name' => 'JournalisationController',
            'journalisation' => $journalisationrepository,
            'id' => $id,
        ]);
    }
}