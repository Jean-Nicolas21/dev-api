<?php

namespace App\State\User;

use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Dto\User\UserDetailsOutput;
use App\Service\UserService;


final readonly class UserRegisterProcessor implements ProcessorInterface
{
    public function __construct(
        private UserService $userService,
    )
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): UserDetailsOutput
    {
        $user = $this->userService->register($data);

        return $this->userService->toDetails($user);

    }
}
