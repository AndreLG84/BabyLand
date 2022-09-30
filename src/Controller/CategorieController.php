<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;


class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie_')]

    public function index(CategorieRepository $CategorieRepository): Response
    {
        $categorie = $CategorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'CategorieController' => $categorie,
        ]);
        dd();
    }

    // #[Route('/categorie/{id}', name: 'app_show_article')]
    // public function showCategory(int $id, CategorieRepository $categorieRepository): Response
    // {
    //     $categorieid = $categorieRepository->find($id);
    //     //dd($article);

    //     return $this->render('welcome/index.html.twig', [
    //         'CategorieController' => $categorieid,
    //     ]);
    // }
}
