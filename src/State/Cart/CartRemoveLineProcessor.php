<?php

namespace App\State\Cart;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Cart;
use App\Service\CartService;

/**
 * @implements ProcessorInterface<Cart, null>
 */
class CartRemoveLineProcessor implements ProcessorInterface
{

    public function __construct(
        private readonly CartService $cartService,
    )
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): null
    {
        $cart = $this->cartService->findOneById($uriVariables['id']);

        $this->cartService->removeLine($cart, $uriVariables['itemId']);

        return null;
    }
}
