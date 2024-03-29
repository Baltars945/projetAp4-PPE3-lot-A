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

class StockController extends AbstractController
{
    #[Route('/stock/{id}', name: 'app_stock')]
    public function index(int $id,Request $Request,LIEUDISPONIBILITERepository $lieudisponibiliterepository
    ,MAGASINRepository $magasinrepository,LIEUENTREPOTRepository $lieuentrepotrepository
    ,ENTREPOTRepository $entrepotrepository, PRODUITRepository $produitrepository): Response
    {
        $lieudisponibilite = $lieudisponibiliterepository ->findAll();
        $magasin = $magasinrepository -> findAll();
        $lieuentrepot = $lieuentrepotrepository -> findAll();
        $entrepot = $entrepotrepository -> findAll();
        $produit = $produitrepository ->findAll();

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
