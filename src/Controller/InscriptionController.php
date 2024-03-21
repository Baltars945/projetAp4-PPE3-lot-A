<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CLIENT;
use App\Repository\CLIENTRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    #[Route('/createutilisateur', name: 'app_createutilisateur')]
    public function createutilisateur(Request $request,EntityManagerInterface $entityManager,CLIENTRepository $clientrepository,UserPasswordHasherInterface $passwordHasher): Response
    {

//Récupération du form de la page d'inscription 

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $password = $_POST['password'];
        $email = $_POST['email'];

//Création du nouveau utilisateur
        $newutilisateur = new CLIENT();
        $newutilisateur -> setNom($nom);
        $newutilisateur -> setPrenom($prenom);
        $newutilisateur -> setEmail($email);
        $newutilisateur -> setNbenfants(0);
// Date de naissance

        $currentDateTime = new \DateTime();
        $datenaissance = $currentDateTime->format('Y-m-d');
        $datenaissanceobject = new \DateTime($datenaissance);

        $newutilisateur ->setDatenaissance($datenaissanceobject);
        
        $clients = $clientrepository->findAll();

        //mettre un truc pour qu'on vérifie qu'il n'y pas deux fois le même code utilisateur 
        $random =  mt_rand(10000000, 99999999);
        $code = "CLI" . $random;
        $newutilisateur -> setCode($code);

//Création du mot de passe du nouveau utilisateur

        $plaintextPassword = $password;

        $hashedPassword = $passwordHasher->hashPassword(
            $newutilisateur,
            $plaintextPassword
        );
        $newutilisateur->setPassword($hashedPassword);
//Création du rôle du nouvel utilisateur 

        $role = ["client"];
        $newutilisateur -> setRoles($role);

//Mise à jour de la bdd
        $entityManager->persist($newutilisateur);
        $entityManager->flush();

        return $this->render('inscription/postInscription.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    /*Une fonction qui permet de créer un code client*/ 
    //public function codeUtilisateur(){
    //    $random =  mt_rand(10000000, 99999999);
    //    $code = "CLI" . $random;

    //    return $code;
    //}
}
