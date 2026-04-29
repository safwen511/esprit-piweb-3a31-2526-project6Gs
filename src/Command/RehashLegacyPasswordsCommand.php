<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:rehash-legacy-passwords',
    description: 'Rehash legacy plain-text user passwords so Symfony login can authenticate them.',
)]
class RehashLegacyPasswordsCommand extends Command
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $users = $this->userRepository->findAll();
        $updated = 0;

        foreach ($users as $user) {
            $password = (string) $user->getPassword();
            if ($this->isAlreadyHashed($password)) {
                continue;
            }

            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            ++$updated;
        }

        if ($updated === 0) {
            $io->success('No legacy plain-text passwords were found.');

            return Command::SUCCESS;
        }

        $this->entityManager->flush();

        $io->success(sprintf('Rehashed %d legacy password(s).', $updated));

        return Command::SUCCESS;
    }

    private function isAlreadyHashed(string $password): bool
    {
        return str_starts_with($password, '$2')
            || str_starts_with($password, '$argon2i$')
            || str_starts_with($password, '$argon2id$');
    }
}
