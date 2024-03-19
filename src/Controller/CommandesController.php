<?php

namespace App\Controller;

use App\Repository\LISTESPORTRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PRODUITRepository;
use App\Repository\COMMANDESRepository;
use App\Repository\PANIERRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\CLIENT;

class CommandesController extends AbstractController
{
    #[Route('/Commandes', name: 'app_commandes')]
    public function index(PRODUITRepository $produitrepository,COMMANDESRepository $commandesrepository,
     PANIERRepository $panierrepository,EntityManagerInterface $entityManager,Security $security): Response
    {
        $client = $security->getUser();
        $user = $entityManager->getRepository(CLIENT::class)->find($client);
        $produit = $produitrepository->findAll();
        $commandes = $commandesrepository->findAll();
        $panier = $panierrepository->findAll();
        return $this->render('Commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
            'produit' => $produit,
            'commandes' => $commandes,
            'panier' => $panier,
            'user' => $user,

        ]);
    }
}
