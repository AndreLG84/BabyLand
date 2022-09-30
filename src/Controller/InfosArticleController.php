<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;

class InfosArticleController extends AbstractController
{
    //Cette instruction définie que l’utilisateur de l’application devra saisir : http://ip:port/infos_article afin d’exécuter la méthode et la route va s’appeler : app_infos_article
    #[Route('/infos_article', name: 'app_infos_article')]

    // La méthode suivante va retourner une réponse qui sera un fichier Twig avec lequel on va lui envoyer le nom du Controller.
    public function index(ArticleRepository $ArticleRepository): Response
    {
        $articles = $ArticleRepository->findAll();

        return $this->render('infos_article/index.html.twig', [
            'InfosArticleController' => $articles,
        ]);
    }

    #[Route('/infos_article/{id}', name: 'app_show_article')]

    public function showArticle(int $id, ArticleRepository $ArticleRepository): Response
    {
        $infosArticle = $ArticleRepository->find($id);

        return $this->render('infos_article/details.html.twig', [
            'InfosArticleController' => $infosArticle,
        ]);
    }

}
