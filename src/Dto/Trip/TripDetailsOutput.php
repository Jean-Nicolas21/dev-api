<?php

namespace App\Dto\Trip;

use ApiPlatform\Metadata\ApiProperty;
use App\Dto\City\CityListOutput;
use Symfony\Component\Uid\Uuid;

final readonly class TripDetailsOutput extends TripListOutput
{
    public function __construct(
        Uuid                   $id,
        CityListOutput         $origin,
        CityListOutput         $destination,
        \DateTimeImmutable     $departureAt,
        int                    $duration,
        int                    $price,

        #[ApiProperty(
            schema: [
                "type" => "integer",
                "description" => "La franchise maximum en kilogramme.",
                "minimum" => 0,
            ]
        )]
        public readonly int    $maxBaggageWeightKg,

        #[ApiProperty(
            schema: [
                "type" => "string",
                "description" => "Le modele de la catapulte."
            ]
        )]
        public readonly string $catapultModel,

        #[ApiProperty(
            schema: [
                "type" => "string",
                "description" => "Les informations d'embarquement."
            ]
        )]
        public readonly string $boardingInfo
    )
    {
        parent::__construct(
            $id,
            $origin,
            $destination,
            $departureAt,
            $duration,
            $price,
        );
    }
}
