<?php

namespace App\Service;

use App\Dto\City\CityListOutput;
use App\Entity\City;
use App\Repository\CityRepository;

class CityService
{

    private const int MAX_RESULTS = 100;
    public const int DEFAULT_LIMIT = 20;

    public function __construct(
        private readonly CityRepository $cityRepository,
    )
    {
    }

    public function search(?string $query = null, ?int $limit = null): array
    {
        $query = trim($query);
        if ($query === '') {
            $query = null;
        }

        //Clamp $limit to [1, MAX_RESULTS]
        $limit = min(self::MAX_RESULTS, max(1, $limit ?? self::DEFAULT_LIMIT));


        return $this->cityRepository->search($query, $limit);
    }

    public function toList(City $city): CityListOutput
    {
        return new CityListOutput(
            id: $city->getId(),
            name: $city->getName(),
        );
    }
}
