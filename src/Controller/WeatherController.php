<?php

namespace App\Controller;

use App\Form\WeatherSearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * @Route("/", name="app_home")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function showAction(Request $request): Response
    {
        if(!$request->isXmlHttpRequest()) {
            $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(WeatherSearchFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $request = $request->request->all();
            $requestData = $request['weather_search_form'];

            $token = $requestData['token'];
            $city = $requestData['city'];


            $url = 'http://api.openweathermap.org/data/2.5/weather?q=';

            $response = $this->client->request(
                'GET',
                $url . $city . '&appid=' . $token
            );

            if (200 !== $response->getStatusCode()) {
                throw new NotFoundHttpException();
            } else {
                return new JsonResponse($response->getContent());
            }
        }

        return $this->render('main/home.html.twig', [
            'form' => $form->createView()
        ]);
    }
}