<?php

namespace App\Dto\Cart;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

final class CartAddLineInput
{
    public function __construct(
        #[Assert\Uuid]
        #[Assert\NotBlank]
        #[ApiProperty(
            required: true,
            schema: [
                'type' => 'string',
                'format' => 'uuid',
                'description' => "L'identifiant unique de lu lancé que l'on ajoute."
            ]
        )]
        public string $tripId,

        #[Assert\Positive]
        #[Assert\NotBlank]
        #[ApiProperty(
            required: true,
            schema: [
                'type' => 'integer',
                "description" => "Le nombre de places sélectionnées pour le trajet.",
                "minimum" => 1,
            ]
        )]
        public int $passengers,
    )
    {
    }
}
