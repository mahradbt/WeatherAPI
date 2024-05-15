<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\HttpFoundation\Request;

class WeatherController extends AbstractController
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository,AA $a)
    {
        $this->cityRepository = $cityRepository;
    }

    public function get(Request $request): mixed
    {
        $data = json_decode($request->getContent(), true);
        $client = new Client();

        $city = $this->cityRepository->checkCity($data['city']);
        if (!$city) {
            return new JsonResponse('$responseData', JsonResponse::HTTP_OK);
        }
        $params = [
            'query' => [
                'latitude' => $city->getLat(),
                'longitude' => $city->getLng(),
                'date' => now(),
                'current' => 'precipitation,rain,showers,snowfall,weather_code,cloud_cover,pressure_msl',
                'daily' => 'temperature_2m_max,temperature_2m_min,sunrise,sunset,daylight_duration,sunshine_duration,uv_index_max',
            ]
        ];
        $response = $client->request('GET', 'https://api.open-meteo.com/v1/forecast', $params);
        $data = $response->getBody()->getContents();
        $responseData = json_decode($data, true);
        $provider =env('provider');
        $a=  new aa;
        a::$provider();
        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }
}



class aa{
    function zz(){

    }
    function xx(){

    }
}