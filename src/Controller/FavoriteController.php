<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends AbstractController
{
    #[Route('/favorite', name: 'app_favorite')]
    public function index(): Response
    {

        return $this->render('favorite/index.html.twig', [
            'controller_name' => 'FavoriteController',
        ]);
    }
    #[Route('/favorite/add/{$id}', name: 'app_favorite_add')]
    public function setFavorite($id): Response{

        return $this->render('favorite/index.html.twig', [
            'controller_name' => 'FavoriteController',
        ]);
    }
    #[Route('/favorite/remove/{$id}', name: 'app_favorite_remove')]
    public function removeFavorite($id): Response{

        return $this->render('favorite/index.html.twig', [
            'controller_name' => 'FavoriteController',
        ]);
    }
}
