<?php

namespace App\Controller;

use App\Repository\LogosRepository;
use App\Repository\ProduitRepository;
use App\Repository\CarouselFrontRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProduitRepository $produitRepository , LogosRepository $logosRepository, CarouselFrontRepository $carouselFrontRepository): Response
    {

        // Identifiants spécifiques des 4 produits que vous souhaitez afficher
        $productIdsToDisplay = [22, 27, 29, 31];

        // Récupérer les produits par leurs identifiants et la catégorie = 2
        $categoryId = 2;
        $produits = $produitRepository->findBy(['id' => $productIdsToDisplay, 'category' => $categoryId]);

        // Identifiants spécifiques des produits de la catégorie=1 que vous souhaitez afficher dans le carousel
        $vetementIds = [63,50,64];
        $categoryIdVetements=1;

        // Récupérer les produits de la catégorie=1 par leurs identifiants
        $vetements = $produitRepository->findBy(['id' => $vetementIds, 'category' =>  $categoryIdVetements]);

        $bijouxIds = [12, 13, 14];
        $categoryBijoux = 3;
        $bijoux = $produitRepository->findBy(['id' => $bijouxIds , 'category' =>  $categoryBijoux]);

        $montresIdsPremiere = [34, 45];
        $categoryMontres = 4;
        $montres1 = $produitRepository->findBy(['id' => $montresIdsPremiere, 'category' =>  $categoryMontres]);

        $montresIdsDeuxieme = [48, 40];
        $categoryMontres2 = 4;
        $montres2 = $produitRepository->findBy(['id' => $montresIdsDeuxieme, 'category' =>  $categoryMontres2]);
        
        $logos = $logosRepository->findAll();
        $carouselImages = $carouselFrontRepository->findAll();
      
    

       
        // Afficher la liste des produits dans le template Twig
        return $this->render('home/index.html.twig', [
            'produits' => $produits,
            'vetements' => $vetements,
            'bijoux' => $bijoux,
            'montres1' => $montres1,
            'montres2' => $montres2,
            'logos' => $logos,
            'carouselImages' => $carouselImages,

        ]);
    }
    public function RecuperationUtilisateur()
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        return $this->render('navbar/navbar.html.twig', [
            'user' => $user,
        ]);
    }
    
 


}
