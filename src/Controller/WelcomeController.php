<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome')]

    public function index(ArticleRepository $ArticleRepository): Response
    {
        $articles = $ArticleRepository->findAll();

        return $this->render('welcome/index.html.twig', [
            'WelcomeController' => $articles,
        ]);
    }

    #[Route('/article/{id}', name: 'app_show_article')]

    public function showArticle(int $id, ArticleRepository $ArticleRepository): Response
    {
        $infosArticle = $ArticleRepository->find($id);
        //dd($article);

        return $this->render('infos_article/details.html.twig', [
            'InfosArticleController' => $infosArticle,
        ]);
    }
}
