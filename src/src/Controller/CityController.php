<?php


namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends AbstractController
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getList(): mixed
    {
        $responseData = $this->cityRepository->getAll();
        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }
}