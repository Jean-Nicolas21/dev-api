<?php

namespace App\Service;

use App\Dto\User\UserDetailsOutput;
use App\Dto\User\UserProfilePictureInput;
use App\Dto\User\UserRegisterInput;
use App\Entity\Enum\DocumentType;
use App\Entity\User;
use App\Exception\User\EmailAlreadyUsedException;
use App\Repository\UserRepository;
use App\Service\Utils\AuditService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Psr\Log\LoggerInterface;

class UserService
{
    public function __construct(
        private readonly UserRepository              $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly AuditService                $auditService,
        private readonly LoggerInterface             $domainLogger,
        private readonly DocumentService              $documentService,
    )
    {
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->userRepository->findOneByEmail($email);
    }

    public function register(UserRegisterInput $input): User
    {
        $existingUser = $this->findOneByEmail($input->email);

        if ($existingUser) {
            $this->domainLogger->error("User registration - conflict : email already used.");
            throw new EmailAlreadyUsedException();

        }

        $user = new User()
            ->setEmail($input->email)
            ->setFirstName($input->firstName)
            ->setLastName($input->lastName);

        $user->setPassword($this->passwordHasher->hashPassword($user, $input->password));

        $this->auditService->stampCreation($user);

        $this->userRepository->persist($user);
        $this->userRepository->flush();

        $this->domainLogger->info("User registered.", ["user_id" => $user->getId()->toRfc4122()]);

        return $user;

    }

    public function toDetails(User $user): UserDetailsOutput
    {
        $picture = $user->getProfilePicture();
        return new UserDetailsOutput(
            id: $user->getId(),
            email: $user->getEmail(),
            firstName: $user->getFirstName(),
            lastName: $user->getLastName(),
            createdAt: $user->getCreatedAt(),
            profilePictureUrl: null === $picture ? null : $this->documentService->toSignedUrl($picture),
        );
    }

    /**
     * Stores a new profile picture for this user and soft-deletes the previous one,
     * in a single write.
     */
    public function changeProfilePicture(User $user, UserProfilePictureInput $input): void
    {
        $newDocument = $this->documentService->store($input->file, DocumentType::ProfilePicture);
        $previousDocument = $user->getProfilePicture();

        if (null !== $previousDocument ) {
            $this->documentService->softDelete($previousDocument);
        }

        $user->setProfilePicture($newDocument);
        $this->auditService->stampUpdate($user);
        $this->userRepository->persist($user);

        $this->userRepository->flush();
    }
}
