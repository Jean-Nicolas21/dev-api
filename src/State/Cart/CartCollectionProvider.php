<?php

namespace App\State\Cart;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Cart\CartDetailsOutput;
use App\Dto\City\CityListOutput;
use App\Entity\User;
use App\Service\CartService;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class CartCollectionProvider implements ProviderInterface
{
    // le service n'est pas construit ici, il est demandé au conteneur
    public function __construct(
        private readonly CartService $cartService,
        private readonly Security    $security,
    )
    {
    }

    /**
     * Serves the city collection, already mapped onto its output payload.
     *
     * @return CartDetailsOutput[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            return [];
        }
        $cart = $this->cartService->findActiveFor($user);

        if (null === $cart) {
            return [];
        }


        return array_map($this->cartService->toDetails(...), [$cart]);
    }
}
