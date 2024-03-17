<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\CLIENT;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    //fonction de base pour la page 
    #[Route('/profil', name: 'app_profil')]
    public function index(Security $security,EntityManagerInterface $entityManager,Request $request): Response
    {
        $client = $security->getUser();
        $profil = $entityManager->getRepository(CLIENT::class)->find($client);

        //boolean utilisé pour afficher ou cacher les labels pour changer les infos dans le twig par un if
        $form = false;
        if ($request->request->has('show')){
            $form = true;
        }


        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'profil' => $profil,
            'form' => $form,
        ]);
    }
    //fonction qui permet de changer les information du client 
    #[Route('/profilinformationsset', name: 'app_profilinformationsset')]
    public function profilinformationsset(Security $security,EntityManagerInterface $entityManager): Response
    {
        $client = $security->getUser();
        $profil = $entityManager->getRepository(CLIENT::class)->find($client);
        
        //toutes les information qui ont été rentré par l'utilisateur 
        $email = $_POST['email'];
        $prenom = $_POST['name'];
        $nom = $_POST['surname'];
        $telephone = $_POST['phoneNumber'];

        //date ne peut avoir comme valeur un string donc il faut le convertir en object
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
            'form' => $form,
        ]);
    }
}
