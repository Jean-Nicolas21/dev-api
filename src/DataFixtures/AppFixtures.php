<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Symfony\Component\Clock\now;

class AppFixtures extends Fixture
{
    private const PLAIN_PASSWORD = 'motdepasse';
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        #region Users
        $aliceUser = new User();
        $aliceUser->setEmail("alice@example.fr");
        $password = $this->hasher->hashPassword($aliceUser, self::PLAIN_PASSWORD);
        $aliceUser->setPassword($password);
        $aliceUser->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($aliceUser);

        $bobUser = new User();
        $bobUser->setEmail("bob@example.fr");
        $password = $this->hasher->hashPassword($bobUser, self::PLAIN_PASSWORD);
        $bobUser->setPassword($password);
        $bobUser->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($bobUser);

        $camilleUser = new User();
        $camilleUser->setEmail("camille.aubert@example.fr");
        $password = $this->hasher->hashPassword($camilleUser, self::PLAIN_PASSWORD);
        $camilleUser->setPassword($password);
        $camilleUser->setFirstName("Camille");
        $camilleUser->setLastName("Aubert");
        $camilleUser->setCreatedAt(new \DateTimeImmutable("2026-02-04T09:00:00"));

        $manager->persist($camilleUser);
        #endregion Users


        $manager->flush();
    }
}
