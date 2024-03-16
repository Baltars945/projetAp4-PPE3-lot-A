<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\CLIENT;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Security $security,EntityManagerInterface $entityManager,Request $request): Response
    {
        $client = $security->getUser();
        $profil = $entityManager->getRepository(CLIENT::class)->find($client);


        $form = false;
        if ($request->request->has('show')){
            $form = true;
        }


        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'profil' => $profil,
            'form' => $form
        ]);
    }
    #[Route('/profilinformationsset', name: 'app_profilinformationsset')]
    public function profilinformationsset(Security $security,EntityManagerInterface $entityManager): Response
    {
        $client = $security->getUser();
        $profil = $entityManager->getRepository(CLIENT::class)->find($client);
        
        $email = $_POST['email'];
        $prenom = $_POST['name'];
        $nom = $_POST['surname'];
        $telephone = $_POST['phoneNumber'];

        $datenaissance = $_POST['birthdate'];
        $datenaissanceobject = new \DateTime($datenaissance);

        $profil->setEmail($email);
        $profil->setNom($nom);
        $profil->setPrenom($prenom);
        $profil->setTelephone($telephone);
        $profil->setDatenaissance($datenaissanceobject);

        $entityManager->flush();

        $form = false;
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'profil' => $profil,
            'form' => $form
        ]);
    }
}
