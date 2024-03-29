<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LIEUDISPONIBILITERepository;
use App\Repository\MAGASINRepository;
use App\Repository\LIEUENTREPOTRepository;
use App\Repository\ENTREPOTRepository;
use App\Repository\PRODUITRepository;
use App\Entity\JOURNALISATION;
use App\Entity\PRODUIT;
use Doctrine\ORM\EntityManagerInterface;
use Datetime;

class StockController extends AbstractController
{
    #[Route('/stock/{id}', name: 'app_stock')]
    public function index(int $id,Request $Request,LIEUDISPONIBILITERepository $lieudisponibiliterepository
    ,MAGASINRepository $magasinrepository,LIEUENTREPOTRepository $lieuentrepotrepository
    ,ENTREPOTRepository $entrepotrepository,EntityManagerInterface $entityManager): Response
    {
        $lieudisponibilite = $lieudisponibiliterepository ->findAll();
        $magasin = $magasinrepository -> findAll();
        $lieuentrepot = $lieuentrepotrepository -> findAll();
        $entrepot = $entrepotrepository -> findAll();
        $total = 0;
        $produit = $entityManager->getRepository(PRODUIT::class)->find($id);
        
        //pour les magasins 
        foreach ($lieudisponibilite as $disponibilite){
            $idproduit = $disponibilite->getProduit()->getId();
            
            if ($idproduit == $id){
                $quantite = $disponibilite -> getQuantite();
                $total += $quantite;
            }
        }

        //pour les entrepots 
        foreach ($lieuentrepot as $entrepot){
            $idproduit = $entrepot -> getProduit()->getId();
            
            if ($idproduit == $id){
                $quantite = $entrepot -> getQuantite();
                $total += $quantite;
            }
        }




        //Création d'une nouvelle valeur journalisation dans le cas d'un seuil critique 
        $seuilcritique = $produit -> getSeuilCritique();
        $journalisation = $produit -> isJournalise();
        if ($seuilcritique > $total){
            if ($journalisation == False){
                $newjournalisation = new JOURNALISATION();

                $currentdatetime = new DateTime();
                $newjournalisation -> setDate($currentdatetime);

                $depassement = $total - $seuilcritique;
                $newjournalisation -> setDepassement($depassement);

                $newjournalisation -> setProduit($produit);

                $produit -> setJournalise(True);
                
                $entityManager->persist($newjournalisation);
                $entityManager->flush();

            }
        }

        $TotalStock = 0;
        $CurrentUrl = $Request->getSchemeAndHttpHost() . $Request->getRequestUri();
        return $this->render('stock/index.html.twig', [
            'controller_name' => 'StockController',
            'id' => $id,
            'lieudisponibilite' => $lieudisponibilite,
            'magasin' => $magasin,
            'lieustockage' => $lieuentrepot,
            'entrepot' => $entrepot,
            'TotalStock' => $TotalStock,
            'produit' => $produit,
        ]);
    }
}
