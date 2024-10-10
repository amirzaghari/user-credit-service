<?php

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListUsersCommand extends Command
{
    protected static $defaultName = 'list-users';

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Lists all users.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->userRepository->getAllUsers();

        if (empty($users)) {
            $output->writeln('No users found.');
            return Command::FAILURE;
        }

        foreach ($users as $user) {
            $output->writeln('User ID: ' . $user->getId() . ' - Name: ' . $user->getName());
        }

        return Command::SUCCESS;
    }
}
