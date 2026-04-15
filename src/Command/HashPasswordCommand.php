<?php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:hash-passwords')]
class HashPasswordCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->em->getRepository(User::class)->findAll();

        foreach ($users as $user) {
            $hashed = $this->hasher->hashPassword($user, 'password123');
            $user->setPassword($hashed);
            $output->writeln('✅ ' . $user->getEmail() . ' → mot de passe hashé');
        }

        $this->em->flush();
        $output->writeln('✅ Tous les mots de passe ont été hashés !');
        return Command::SUCCESS;
    }
}