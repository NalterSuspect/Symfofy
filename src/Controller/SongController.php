<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\AuthSpotifyService;
use Doctrine\Common\Lexer\Token;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SongController extends AbstractController
{
    private string $token;
    public function __construct(
        private readonly AuthSpotifyService  $authSpotifyService,
        private readonly HttpClientInterface $httpClient,
    )
    {
        $this->token = $this->authSpotifyService->auth();
    }

    #[Route('/song', name: 'app_song')]
    public function index(): Response
    {
        // Make the GET request to the Spotify API with kazzey as the query and the token as the Authorization header
        $response = $this->httpClient->request('GET', 'https://api.spotify.com/v1/albums/1PuCoaLQNyCeaLBgGtNyW3?si=QYmhIfK_SiCK7cwOmFRKAA', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);


        //dd($response->toArray()['tracks']['items']);
        $tracks=$response->toArray()['tracks']['items'];
        //$tracks = $this->trackFactory->createMultipleFromSpotifyData($response->toArray()['tracks']['items']);

        return $this->render('song/index.html.twig', [
            'controller_name' => 'SongController',
            'tracks' => $tracks,
        ]);
    }
}
