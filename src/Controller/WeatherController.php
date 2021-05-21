<?php

namespace App\Controller;

use App\Form\WeatherSearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $form = $this->createForm(WeatherSearchFormType::class);

        if ($request->isXmlHttpRequest()) {
            $request = $request->request->all();
            $requestData = $request['weather_search_form'];

            $token = $requestData['token'];
            $city = $requestData['city'];

            $returnData = ['message' => 'success'];
            return new JsonResponse($returnData);
        }

        return $this->render('main/home.html.twig', [
            'form' => $form->createView()
        ]);
    }
}