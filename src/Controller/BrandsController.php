<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MarqueRepository;
use App\Repository\ArticleRepository;

class BrandsController extends AbstractController
{
    #[Route('/brands', name: 'app_brands_')]

    public function index(MarqueRepository $MarqueRepository): Response
    {
        $brands = $MarqueRepository->findAll();
        //dd($brands);

        return $this->render('brands/index.html.twig', [
            'BrandsController' => $brands,
        ]);
    }

    #[Route('/infos_brand/{id}', name: 'app_show_brand')]
    public function watchBrand(int $id, MarqueRepository $MarqueRepository, ArticleRepository $ArticleRepository): Response
    {
        $listArt = [];

        $infoBrand = $MarqueRepository ->find($id);
        $articleBrand = $ArticleRepository ->find($id);

        $listArt []= $infoBrand.$articleBrand;

        return $this->render('brands/details.html.twig', [
            'BrandsController' => $listArt[0],
        ]);

    }
}
