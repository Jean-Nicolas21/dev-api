<?php

namespace App\Dto\Ticket;

use App\Dto\Trip\TripListOutput;
use App\Entity\Trip;
use Symfony\Component\Uid\Uuid;
use ApiPlatform\Metadata\ApiProperty;

final class TicketListOutput
{
    public function __construct(
        #[ApiProperty(
            schema: [
                "type" => "string",
                "format" => "uuid",
                "description" => "L'identifiant unique du ticket.",
            ]
        )]
        public readonly Uuid $id,

        #[ApiProperty(
            schema: [
                "description" => "Le lancer sur lequel le billet donne droit d'embarquement."
            ]
        )]
        public readonly TripListOutput $trip,

        #[ApiProperty(
            schema: [
                "type" => "integer",
                "description" => "Le prix acquitté, en centimes."
            ]
        )]
        public readonly int $price,

        #[ApiProperty(
            schema: [
                "type" => "string",
                "format" => "date-time",
                "description" => "Date d'émission du ticket."
            ]
        )]
        public readonly \DateTimeImmutable $createdAt
    )
    {
    }
}
