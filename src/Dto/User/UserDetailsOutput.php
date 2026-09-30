<?php

namespace App\Dto\User;

use ApiPlatform\Metadata\ApiProperty;
use DateTimeImmutable;

class UserDetailsOutput
{
    public function __construct(
        #[ApiProperty(
            schema: [
                'type' => 'string',
                'format' => 'uuid',
                'description' => 'Identifiant unique de l\'utilisateur.',
            ]
        )]
        public string $id,

        #[ApiProperty(
            schema: [
                "type" => "string",
                "format" => "email",
                "description" => "Le courriel de l'utilisateur. Il doit être unique.",
            ])]
        public string $email,

        #[ApiProperty(
            required: false,
            schema: [
                "type" => "string",
                "description" => "Le prénom de l'utilisateur.(facultatif)",
                "example" => "Jean",
                "nullable" => true,
            ])]
        public ?string $firstName = null,

        #[ApiProperty(
            required: false,
            schema: [
                "type" => "string",
                "description" => "Le nom de l'utilisateur.(facultatif)",
                "example" => "Neymar",
                "nullable" => true,
            ])]
        public ?string $lastName= null,

        #[ApiProperty(
            schema: [
                "type" => "string",
                "format" => "date-time",
                "description" => "La date à laquelle le compte a été créée.",
            ])]
        public DateTimeImmutable $createdAt,
    )
    {
    }
}
