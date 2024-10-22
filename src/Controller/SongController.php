<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\AuthSpotifyService;
use Doctrine\Common\Lexer\Token;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Factory\SongFactory;
use App\Factory\AlbumFactory;
use App\Factory\ArtistFactory;

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
    public function index(Request $request): Response
    {

        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $results=null;
        $search_param=$request->query->all();
        $defaultData = ['message' => 'Type your message here'];
        $options=['album'=>'album','artist'=>'artist','track'=>'track'];
        $form = $this->createFormBuilder($defaultData)
            ->add('search', TextType::class)
            ->add('type',ChoiceType::class,[
                'choices'  => $options,
            ])
            ->add('send', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('app_song', ['search' => $form->getData()['search'],'type'=>$form->getData()['type']]);
        }

        if($search_param) {
            $type=$search_param['type'];
            $endpoint="https://api.spotify.com/v1/search?";
            $params=[
                'q'=>$search_param['search'],
                'type'=>$type,
                'market'=>'ES',
                'limit'=>'10',
                'offset'=>'1',
                'include_external'=>'audio',
            ];
            $query=http_build_query($params);

            $response = $this->httpClient->request('GET', $endpoint.$query, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
            switch ($search_param['type']){
                case 'track':
                    $results=SongFactory::songFactory($response->toArray());
                    break;
                    case 'album':
                        $results=AlbumFactory::albumFactory($response->toArray());
                        break;
                        case 'artist':
                            $results=ArtistFactory::artistFactory($response->toArray());
                            break;
                        default:
                            $results=[];
            }
        }

        return $this->render('song/index.html.twig', [
            'results' => $results,
            'form' => $form,
        ]);
    }
}
