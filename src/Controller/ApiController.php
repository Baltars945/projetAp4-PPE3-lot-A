<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PRODUITRepository;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(PRODUITRepository $produitrepository,SerializerInterface $serializer): JsonResponse
    {
        $produit = $produitrepository->findAll();
        $produitlist = $serializer -> serialize($produit,'json',['groups'=>'produitslist']);
        return new JsonResponse($produitlist,Response::HTTP_OK, [], true
        );
    }
}
