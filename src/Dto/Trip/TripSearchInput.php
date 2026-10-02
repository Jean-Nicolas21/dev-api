<?php

namespace App\Dto\Trip;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

final class TripSearchInput
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Uuid]
        #[ApiProperty(
            required: true,
            schema: [
                "type" => "string",
                "format" => "uuid",
                "description" => "L'identifiant unique de la ville de départ.",
            ]
        )]
        public string $origin,

        #[Assert\NotBlank]
        #[Assert\Uuid]
        #[ApiProperty(
            required: true,
            schema: [
                "type" => "string",
                "format" => "uuid",
                "description" => "L'identifiant unique de la ville de destination.",
            ]
        )]
        public string $destination,

        #[Assert\NotBlank]
        #[Assert\Date]
        #[ApiProperty(
            required: true,
            schema: [
                "type" => "string",
                "format" => "date",
                "description" => "Le jour de départ du lancé."
            ]
        )]
        public string $date,

        #[Assert\NotBlank]
        #[Assert\Positive]
        #[ApiProperty(
            required: true,
            schema: [
                "type" => "integer",
                "description" => "Le nombre de passagers."
            ]
        )]
        public int $passengers,

    )
    {
    }
}
