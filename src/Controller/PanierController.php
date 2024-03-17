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
    /*Fonction qui permet d'arriver sur la page du panier il est nécessaire d'être connecté pour y accéder
    il y a deux possibilité 
    soit on vient du header et donc on ne fait que regarder la page et tout ses produit avec la possibilité de les confirmer
    et ou de les supprimer 
    ou alors on vient de la page article et on a ajouté un article */ 
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

        //dans le cas ou on vient pas de la page article mais du header
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
    La commande ayant déjà été créer dans l'index il ne reste plus qu'à changer la valeur état de la table panier
    désormais elle n'apparaitra plus dans le panier étant donné qu'elle est considérer comme "confirmer/payé" */
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

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'produit' => $produits,
            'commande' => $commande,
            'panier' => $panier,
            'user' => $user,
        ]);
    }

    //fonction qui permet de supprimer une commande du panier 
     #[Route('/supprimercommande', name:'app_supprimercommande')]
    public function supprimercommande(Security $security,Request $request,EntityManagerInterface $entityManager
    ,PRODUITRepository $produitrepository,COMMANDESRepository $commanderepository,PANIERRepository $panierrepository){
        //récuperation de toutes les informations principalement pour le render
        $client = $security->getUser();
        $produits = $produitrepository->findAll();
        $user = $entityManager->getRepository(CLIENT::class)->find($client);
        $commande = $commanderepository->findAll();
        $panier = $panierrepository ->findAll();

        //récupération du panier et de la commande
        $idpanier = $_POST['idpanier'];
        $idcommande = $_POST['idcommande'];
        $thispanier = $entityManager->getRepository(PANIER::class)->find($idpanier);
        $thiscommande = $entityManager->getRepository(COMMANDES::class)->find($idcommande);

        //suppression de panier avant la commande sinon il y a conflit de fk
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

