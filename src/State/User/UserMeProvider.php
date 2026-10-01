<?php

namespace App\State\User;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\User\UserDetailsOutput;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class UserMeProvider implements ProviderInterface
{
    public function __construct(
        private Security    $security,
        private UserService $userService,
    ) {
    }

    // la signature de provide() est documentée par API Platform : allez la relever
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?UserDetailsOutput
    {
        $connectedUser = $this->security->getUser();

        if (!$connectedUser instanceof User) {
            return null;
        }

        return $this->userService->toDetails($connectedUser);


    }
}
