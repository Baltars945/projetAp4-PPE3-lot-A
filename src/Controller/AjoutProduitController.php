<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PRODUIT;
use App\Entity\LISTESPORTS;
use Doctrine\ORM\EntityManagerInterface;

class AjoutProduitController extends AbstractController
{
    #[Route('/ajout/produit', name: 'app_ajout_produit')]
    public function index(): Response
    {

        return $this->render('ajoutproduit/index.html.twig', [
            'controller_name' => 'AjoutProduitController',
        ]);
    }

    #[Route('/ajoutproduit', name : 'app_ajout')]
    public function ajoutproduit(): Response
    {
                
        //récupération des informations du form 
        $Nom = $_POST['Nom'];
        $Prix = $_POST['Prix'];
        $Description = $_POST['Description'];
        $Fournisseur = $_POST['Fournisseur'];
        $FromSport = $_POST['sport'];
        $SeuilCritique = $_POST['SeuilCritique'];

        $sport = $entityManager->getRepository(LISTESPORTS::class)->find($sport);
        
        //Création du nouveau produit 
        $newproduit = new PRODUIT();

        $newproduit -> setNom($Nom);
        $newproduit -> setPrix($Prix);
        $newproduit -> setDescription($Description);
        $newproduit -> setFournisseur($Fournisseur);
        $newproduit -> setSport($FromSport);
        $newproduit -> setSeuilCritique($SeuilCritique);
        $newproduit -> setJournalise(false);


        $entityManager->persist($newproduit);
        $entityManager->flush();

        return $this->render('ajout_produit/index.html.twig', [
            'controller_name' => 'AjoutProduitController',
        ]);
    }
}
