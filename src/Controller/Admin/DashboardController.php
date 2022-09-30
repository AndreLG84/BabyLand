<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Marque;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ArticleCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BabyLandAdministration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Articles');
        yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Create Article', 'fas fa-plus-circle', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Articles', 'fas fa-eye', Article::class),
        ]);

        yield MenuItem::section('Categories');
        yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Create Categorie', 'fas fa-plus-circle', Categorie::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories', 'fas fa-eye', Categorie::class),
        ]);

        yield MenuItem::section('Marques');
        yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajoutez une marque', 'fas fa-plus-circle', Marque::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Marques', 'fas fa-eye', Marque::class),
        ]);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
