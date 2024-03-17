<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PRODUITRepository;
use App\Repository\COMMANDESRepository;
use App\Repository\PANIERRepository;
use App\Entity\PANIER;
use App\Entity\PRODUIT;
use App\Entity\COMMANDES;
use App\Entity\CLIENT;
use Doctrine\ORM\EntityManagerInterface;
use Datetime;
use Symfony\Component\Security\Core\Security;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(Request $request,PRODUITRepository $produitrepository,EntityManagerInterface $entityManager
    ,Security $security, COMMANDESRepository $commanderepository, PANIERRepository $panierrepository): Response
    {
        //les variables qu'ont envoient dans les deux return
        $client = $security->getUser();
        $produits = $produitrepository->findAll();
        $user = $entityManager->getRepository(CLIENT::class)->find($client);
        $commande = $commanderepository->findAll();
        $panier = $panierrepository ->findAll();

        //dans le cas ou on vient pas de la page article 
        if ($request->isMethod('POST')) {
            if ($request->request->has('quantite') && $request->request->has('produitid')){
        $quantite = $_POST['quantite'];
        $produitid = $_POST['produitid'];


        $produit = $entityManager->getRepository(PRODUIT::class)->find($produitid);
        $produitprix = $produit->getPrix();
        $currentdatetime = new DateTime();
        
        //création du panier

        $newpanier = new PANIER();
        $newpanier ->setQuantite($quantite);
        $newpanier ->setProduit($produit);
        $newpanier ->setétat(0);

        //création de la commande
        $newcommande = new COMMANDES();
        $newcommande -> setEtat("non confirmer");
        $newcommande -> setPrixtotal($produitprix * $quantite);
        $newcommande -> setDate($currentdatetime);
        $newcommande -> setClient($user);

        $entityManager->persist($newcommande);
        $entityManager->flush();

        
        $newpanier ->setCommande($newcommande);

        $entityManager->persist($newpanier);


        $entityManager->flush();
    }}
    return $this->render('panier/index.html.twig', [
        'controller_name' => 'PanierController',
        'produit' => $produits,
        'commande' => $commande,
        'panier' => $panier,
        'user' => $user,
    ]);
    }
    /*Fonction permettant d'ajouter une commande 
    Celle ci crée une entrée pour l'entité COMMANDE et PANIER puis met à jour la base de donnée 
    étant donné que l'utilisateur n'a pas été mis en place on créer une entrée panier avec la commande*/
    #[Route('/confirmercommande', name:'app_confirmercommande')]
    public function confirmercommande(Security $security,Request $request,EntityManagerInterface $entityManager
    ,PRODUITRepository $produitrepository,COMMANDESRepository $commanderepository,PANIERRepository $panierrepository): Response 
    {
        $client = $security->getUser();
        $produits = $produitrepository->findAll();
        $user = $entityManager->getRepository(CLIENT::class)->find($client);
        $commande = $commanderepository->findAll();
        $panier = $panierrepository ->findAll();


        $idpanier = $_POST['idpanier'];
        $idcommande = $_POST['idcommande'];
        $thispanier = $entityManager->getRepository(PANIER::class)->find($idpanier);
        $thiscommande = $entityManager->getRepository(COMMANDES::class)->find($idcommande);

        $thispanier ->setétat(1);
        $thiscommande ->setetat("confirmé");

        $entityManager->flush();
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'produit' => $produits,
            'commande' => $commande,
            'panier' => $panier,
            'user' => $user,
        ]);
    }
     #[Route('/supprimercommande', name:'app_supprimercommande')]
    public function supprimercommande(Security $security,Request $request,EntityManagerInterface $entityManager
    ,PRODUITRepository $produitrepository,COMMANDESRepository $commanderepository,PANIERRepository $panierrepository){
        $client = $security->getUser();
        $produits = $produitrepository->findAll();
        $user = $entityManager->getRepository(CLIENT::class)->find($client);
        $commande = $commanderepository->findAll();
        $panier = $panierrepository ->findAll();

        $idpanier = $_POST['idpanier'];
        $idcommande = $_POST['idcommande'];
        $thispanier = $entityManager->getRepository(PANIER::class)->find($idpanier);
        $thiscommande = $entityManager->getRepository(COMMANDES::class)->find($idcommande);

        $entityManager->remove($thispanier);
        $entityManager->remove($thiscommande);
        $entityManager->flush();

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'produit' => $produits,
            'commande' => $commande,
            'panier' => $panier,
            'user' => $user,
        ]);
    }
}

