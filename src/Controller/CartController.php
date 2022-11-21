<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;


#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index_')]
    public function index(SessionInterface $session, ArticleRepository $articleRepository)
    {
        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 0;
        foreach($panier as $id => $quantite){
            $produit = $articleRepository->find($id);
            $dataPanier []  = [
                "panier" => $produit,
                "quantite" => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        }
        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }

    #[Route('/add/{id}', name: 'add')]
    public function add($id, SessionInterface $session)
    {
        // on recupere le panier actuel
        $panier = $session->get("panier", []);
        if (!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        // on sauvegarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index_");
    }


    #[Route('/delete', name: 'delete')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("cart_index_");
    }
}
