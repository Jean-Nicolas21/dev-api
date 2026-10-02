<?php

namespace App\Dto\Trip;

use ApiPlatform\Metadata\ApiProperty;
use App\Dto\City\CityListOutput;
use Symfony\Component\Uid\Uuid;

readonly class TripListOutput
{
    public function __construct(
        #[ApiProperty(
            schema: [
                "type" => "string",
                "format" => "uuid",
                "description" => "L'identifiant unique du lancé."
            ]
        )]
        public Uuid               $id,

        #[ApiProperty(
            schema: [
                "description" => "La ville de départ.",
            ]
        )]
        public CityListOutput     $origin,

        #[ApiProperty(
            schema: [
                "description" => "La ville de destination.",
            ]
        )]
        public CityListOutput     $destination,

        #[ApiProperty(
            schema: [
                "type" => "string",
                "format" => "date-time",
                "description" => "Le date et le l'horaire de départ du lancé.."
            ]
        )]
        public \DateTimeImmutable $departureAt,

        #[ApiProperty(
            schema: [
                "type" => "integer",
                "description" => "Durée du vvoyage en minutes."
            ]
        )]
        public int                $duration,

        #[ApiProperty(
            schema: [
                "type" => "integer",
                "description" => "Prix du voyage en centimes."
            ]
        )]
        public int                $price,
    )
    {
    }
}
