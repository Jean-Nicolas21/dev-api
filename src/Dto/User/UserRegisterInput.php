<?php

namespace App\Dto\User;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterInput
{

    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        #[Assert\Length(min: 3, max: 255)]
        #[ApiProperty(
            required: true,
            schema: [
            "type" => "string",
            "format" => "email",
            "minLength" => 3,
            "maxLength" => 255,
            "description" => "Le courriel de l'utilisateur. Il doit être unique.",
            "example" => "user@example.com",
        ])]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\Length(min: 8, max: 255)]
        #[Assert\PasswordStrength]
        #[ApiProperty(
            required: true,
            schema: [
            "type" => "string",
            "format" => "password",
            "minLength" => 8,
            "maxLength" => 255,
            "description" => "Le mot de passe de l'utilisateur. Il doit comporter à minima 3 caractères et son longueur maximum est de 255 caractères.",
            "example" => "password",
        ])]
        public string $password,

        #[Assert\NotBlank(allowNull: true)]
        #[Assert\Length(min: 3, max: 255)]
        #[ApiProperty(
            required: false,
            schema: [
            "type" => "string",
            "minLength" => 3,
            "maxLength" => 255,
            "description" => "Le prénom de l'utilisateur.",
            "example" => "Jean",
        ])]
        public ?string $firstName = null,

        #[Assert\NotBlank(allowNull: true)]
        #[Assert\Length(min: 3, max: 255)]
        #[ApiProperty(
            required: false,
            schema: [
            "type" => "string",
            "minLength" => 3,
            "maxLength" => 255,
            "description" => "Le nom de l'utilisateur.",
            "example" => "Neymar",
        ])]
        public ?string $lastName = null,
    )
    {
    }
}
