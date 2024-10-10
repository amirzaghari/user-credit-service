<?php

namespace UserCredit\Command;

use UserCredit\Repository\UserRepository;

class ListUsersCommand
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): void
    {
        $users = $this->userRepository->getAllUsers();
        foreach ($users as $user) {
            echo "ID: {$user->getId()}, Name: {$user->getName()}, Credit: {$user->getCredit()}\n";
        }
    }
}
