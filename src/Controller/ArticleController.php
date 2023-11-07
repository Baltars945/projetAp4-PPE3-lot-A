<?php

namespace App\Controller;

use App\Repository\PRODUITRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(PRODUITRepository $produitRepositary): Response
    {
        $produit = $produitRepositary->find($_GET['id']);
        return $this->render('article/index.html.twig', [
            "article" => $produit,
            'controller_name' => 'ArticleController',
        ]);
    }
}
