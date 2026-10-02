<?php

namespace App\State\Trip;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Trip\TripDetailsOutput;
use App\Dto\User\UserDetailsOutput;
use App\Entity\Trip;
use App\Entity\User;
use App\Service\TripService;
use App\Service\UserService;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class TripItemProvider implements ProviderInterface
{
    public function __construct(
        private TripService $tripService,
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?TripDetailsOutput
    {
        $trip = $this->tripService->findOneById($uriVariables['id']);

        return $this->tripService->toDetails($trip);
    }
}
