<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DebugUsersController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
    )
    {
    }

    #[Route('/debug/users', name: 'app_debug_users', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json(
            $this->userRepository->findAll(),
        );
    }
}
